<?php

declare(strict_types=1);

namespace Auth0\SDK\Mixins;

use const ENT_QUOTES;
use const ENT_SUBSTITUTE;

use Throwable;

use function array_key_exists;
use function count;
use function in_array;
use function is_array;
use function is_callable;
use function is_scalar;
use function is_string;

trait ConfigurableMixin
{
    /**
     * @param null|array<mixed> $configuration
     *
     * @psalm-suppress MissingClosureParamType,MissingClosureReturnType
     */
    private function applyConfiguration(?array $configuration): self
    {
        if (null === $configuration) {
            return $this;
        }

        $validators = $this->getPropertyValidators();
        $defaults = $this->getPropertyDefaults();

        foreach ($configuration as $configKey => $configuredValue) {
            if (! property_exists($this, $configKey)) {
                continue;
            }

            if (! array_key_exists($configKey, $defaults)) {
                continue;
            }

            // @phpstan-ignore-next-line
            if (! isset($validators[$configKey]) || ! is_callable($validators[$configKey])) {
                throw \Auth0\SDK\Exception\ConfigurationException::validationFailed($configKey);
            }

            if ($validators[$configKey]($configuredValue) === false) {
                throw \Auth0\SDK\Exception\ConfigurationException::validationFailed($configKey);
            }

            $method = 'set' . ucfirst($configKey);

            if (method_exists($this, $method)) {
                /** @phpstan-ignore-next-line */
                $callback = function ($configuredValue) use ($method) {
                    // @phpstan-ignore-next-line
                    return $this->{$method}($configuredValue);
                };

                $callback($configuredValue);

                continue;
            }

            // @phpstan-ignore-next-line
            $this->{$configKey} = $configuredValue;
        }

        return $this;
    }

    /**
     * @param mixed          $value     a value to compare against NULL
     * @param null|Throwable $throwable Optional. A Throwable exception to raise if $value is NULL.
     */
    private function exceptionIfNull($value, ?Throwable $throwable = null): void
    {
        if (null === $value && $throwable instanceof Throwable) {
            throw $throwable;
        }
    }

    /**
     * @param null|array<string> $filtering an array of strings to filter, or NULL
     * @param bool               $keepKeys  Optional. Whether to keep array keys or reindex the array appropriately.
     *
     * @return null|array<string>
     *
     * @psalm-suppress DocblockTypeContradiction,RedundantCastGivenDocblockType
     */
    private function filterArray(?array $filtering, bool $keepKeys = false): ?array
    {
        if (! is_array($filtering) || [] === $filtering) {
            return null;
        }

        $filtered = [];

        foreach ($filtering as $i => $s) {
            // @phpstan-ignore-next-line
            if (! is_scalar($s)) {
                continue;
            }

            $s = trim((string) $s);

            if ('' !== $s && ! in_array($s, $filtered, true)) {
                $filtered[$i] = $s;
            }
        }

        if ([] === $filtered) {
            return null;
        }

        if (! $keepKeys) {
            return array_values($filtered);
        }

        return $filtered;
    }

    /**
     * @param null|array<mixed> $filtering an array to filter, or NULL
     * @param bool              $keepKeys  Optional. Whether to keep array keys or reindex the array appropriately.
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

            if ('' !== $s && null !== $s && ! array_key_exists($i, $filtered)) {
                $filtered[$i] = $s;
            }
        }

        if ([] === $filtered) {
            return null;
        }

        if (! $keepKeys) {
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

            // @codeCoverageIgnoreStart
            if (! is_string($host) || '' === $host) {
                return null;
            }
            // @codeCoverageIgnoreEnd

            $parts = explode('.', $host);

            if (count($parts) < 2) {
                return null;
            }

            $tld = end($parts);

            if (mb_strlen($tld) < 2) {
                return null;
            }

            return $host;
        }

        return null;
    }

    /**
     * @param string $string A string to apply sanitization filtering to.
     *
     * @psalm-suppress UnusedFunctionCall
     */
    private function filterString(string $string): string
    {
        mb_regex_encoding('UTF-8');

        $processed = trim($string);
        $processed = trim(htmlspecialchars_decode($processed, ENT_QUOTES | ENT_SUBSTITUTE));
        $processed = trim(strip_tags($processed));
        $processed = trim(htmlspecialchars($processed, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false));
        $processed = mb_ereg_replace('[^\p{Ll}\p{Lu}\p{Nd}\p{Pd}\p{Pc}\p{Zs}\:\/\.\?\=]', '', $processed);

        return (is_string($processed) && '' !== $processed) ? $processed : '';
    }

    /**
     * @psalm-suppress MissingClosureParamType,MissingClosureReturnType
     */
    private function validateProperties(): void
    {
        $defaults = $this->getPropertyDefaults();

        foreach ($defaults as $configKey => $defaultValue) {
            if (! property_exists($this, $configKey)) {
                continue;
            }

            // @phpstan-ignore-next-line
            if ($this->{$configKey} === $defaultValue) {
                continue;
            }

            $method = 'set' . ucfirst($configKey);

            if (method_exists($this, $method)) {
                /** @phpstan-ignore-next-line */
                $callback = function ($value) use ($method) {
                    // @phpstan-ignore-next-line
                    return $this->{$method}($value);
                };

                // @phpstan-ignore-next-line
                $callback($this->{$configKey});

                continue;
            }
        }
    }
}
