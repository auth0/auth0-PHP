<?php

declare(strict_types=1);

namespace Auth0\SDK\Mixins;

use Throwable;

trait ConfigurableMixin
{
    /**
     * @param null|array<mixed> $configuration
     *
     * @psalm-suppress MissingClosureParamType,MissingClosureReturnType
     */
    private function applyConfigurationState(?array $configuration): self
    {
        if (null === $configuration) {
            return $this;
        }

        foreach ($configuration as $configurationKey => $configurationValue) {
            if (property_exists($this, $configurationKey)) {
                $method = 'set' . ucfirst($configurationKey);

                if (method_exists($this, $method)) {
                    $callback = function ($configurationValue) use ($method) {
                        // @phpstan-ignore-next-line
                        return $this->$method($configurationValue);
                    };

                    call_user_func($callback, $configurationValue);
                    continue;
                }

                // @phpstan-ignore-next-line
                $this->$configurationKey = $configurationValue;
            }
        }

        return $this;
    }

    /**
     * @param mixed $value A value to compare against NULL.
     * @param null|Throwable $throwable Optional. A Throwable exception to raise if $value is NULL.
     */
    private function exceptionIfNull($value, ?\Throwable $throwable = null): void
    {
        if (null === $value && null !== $throwable) {
            throw $throwable;
        }
    }

    /**
     * @param null|array<string> $filtering An array of strings to filter, or NULL.
     * @param bool $keepKeys Optional. Whether to keep array keys or reindex the array appropriately.
     *
     * @return null|array<string>
     */
    private function filterArray(?array $filtering, bool $keepKeys = false): ?array
    {
        if (! is_array($filtering) || [] === $filtering) {
            return null;
        }

        $filtered = [];

        foreach ($filtering as $i => $s) {
            $s = trim($s);

            if ('' !== $s && ! in_array($s, $filtered, true)) {
                $filtered[$i] = $s;
            }
        }

        if ([] === $filtered) {
            return null;
        }

        if (!$keepKeys) {
            return array_values($filtered);
        }

        return $filtered;
    }

    /**
     * @param null|array<mixed> $filtering An array to filter, or NULL.
     * @param bool $keepKeys Optional. Whether to keep array keys or reindex the array appropriately.
     *
     * @return null|array<mixed>
     */
    private function filterArrayMixed(?array $filtering, bool $keepKeys = false): ?array
    {
        if (! is_array($filtering) || [] === $filtering) {
            return null;
        }

        $filtered = [];

        foreach ($filtering as $i => $s) {
            if (is_string($s)) {
                $s = trim($s);
            }

            if ('' !== $s && (is_int($i) && ! in_array($s, $filtered, true) || is_string($i) && ! array_key_exists($i, $filtered))) {
                $filtered[$i] = $s;
            }
        }

        if ([] === $filtered) {
            return null;
        }

        if (!$keepKeys) {
            return array_values($filtered);
        }

        return $filtered;
    }

    private function filterDomain(string $domain): ?string
    {
        $domain = $this->filterString($domain);

        if ('' !== $domain) {
            $scheme = parse_url($domain, PHP_URL_SCHEME);

            if (! is_string($scheme) || '' === $scheme) {
                return $this->filterDomain('https://' . $domain);
            }

            $host = parse_url($domain, PHP_URL_HOST);

            if (! is_string($host)) {
                return null;
            }

            if ($host === '') {
                return null;
            }

            $parts = explode('.', $host);

            if (count($parts) < 2) {
                return null;
            }

            $tld = end($parts);

            if (strlen($tld) < 2) {
                return null;
            }

            return $host;
        }

        return null;
    }

    private function filterString(string $str, bool $allowLineBreaks = false): string
    {
        $filtered = $this->filterStringUtf8($str);

        if (strpos($filtered, '<') !== false) {
            $filtered = preg_replace_callback('%<[^>]*?((?=<)|>|$)%', function ($matches) {
                if (false !== strpos($matches[0], '>')) {
                    return $this->filterHtml($matches[0]);
                }
                return $matches[0];
            }, $filtered) ?? '';
            $filtered = $this->filterStringTags($filtered, false);
            $filtered = str_replace("<\n", "&lt;\n", $filtered);
        }

        if (! $allowLineBreaks) {
            $filtered = preg_replace('/[\r\n\t ]+/', ' ', $filtered) ?? '';
        }

        $filtered = trim($filtered);
        $found = false;

        while (preg_match('/%[a-f0-9]{2}/i', $filtered, $match)) {
            $filtered = str_replace($match[0], '', $filtered);
            $found = true;
        }

        if ($found) {
            $filtered = preg_replace('/ +/', ' ', $filtered);

            if ($filtered !== null) {
                $filtered = trim($filtered);
            }
        }

        if (! is_string($filtered)) {
            return '';
        }

        return $filtered;
    }

    private function filterHtml(string $str, int $flags = ENT_QUOTES|ENT_SUBSTITUTE): string
    {
        if ('' === $str) {
            return '';
        }

        if (false === preg_match('/[&<>"\']/', $str)) {
            return $str;
        }

        return htmlspecialchars($str, $flags, 'UTF-8', false);
    }

    private function filterStringTags(string $str, bool $allowLineBreaks = false): string
    {
        $str = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $str);

        if (null === $str) {
            return '';
        }

        $str = strip_tags($str);

        if (! $allowLineBreaks) {
            $str = preg_replace('/[\r\n\t ]+/', ' ', $str);

            if (null === $str) {
                return '';
            }
        }

        return trim($str);
    }

    private function filterStringUtf8(string $str, bool $strip = false): string
    {
        if ($str === '') {
            return '';
        }

        static $pcreSupported = null;

        if ($pcreSupported === null) {
            try {
                $pcreSupported = preg_match('/^./u', 'a');
            } catch (\Throwable $th) {
                $pcreSupported = false;
            }
        }

        if (! $pcreSupported) {
            return $str;
        }

        if (1 === @preg_match('/^./us', $str)) {
            return $str;
        }

        if ($strip && function_exists('iconv')) {
            $response = iconv('utf-8', 'utf-8', $str);

            if (is_string($response)) {
                return $response;
            }
        }

        return '';
    }
}
