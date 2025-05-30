<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use JsonException;
use Psr\Http\Message\{ResponseInterface, StreamInterface};

final class HttpResponse
{
    /**
     * Extract the content from an HTTP response and parse as JSON (ResponseInterface).
     *
     * @param ResponseInterface $response a ResponseInterface instance to extract from
     *
     * @throws JsonException when JSON decoding fails
     *
     * @return mixed
     */
    public static function decodeContent(
        ResponseInterface $response,
    ) {
        return json_decode(self::getContent($response), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Extract the content from an HTTP response (ResponseInterface).
     *
     * @param ResponseInterface $response a ResponseInterface instance to extract from
     *
     * @psalm-suppress RedundantConditionGivenDocblockType
     */
    public static function getContent(
        ResponseInterface $response,
    ): string {
        $body = $response->getBody();

        // True response bodies are of type StreamInterface and need transformed to strings.
        if ($body instanceof StreamInterface) { // @phpstan-ignore-line
            return $body->__toString();
        }

        // @phpstan-ignore-next-line
        return (string) $body;
    }

    /**
     * Extract the headers from an HTTP response (ResponseInterface).
     *
     * @param ResponseInterface $response a ResponseInterface instance to extract from
     *
     * @return array<array<string>>
     */
    public static function getHeaders(
        ResponseInterface $response,
    ): array {
        return $response->getHeaders();
    }

    /**
     * Extract the status code from an HTTP response (ResponseInterface).
     *
     * @param ResponseInterface $response a ResponseInterface instance to extract from
     */
    public static function getStatusCode(
        ResponseInterface $response,
    ): int {
        return $response->getStatusCode();
    }

    /**
     * Helper function to parse "b=per_hour;q=100;r=99;t=1,b=per_day;q=300;r=299;t=1"
     * into an array like:
     * [
     *    'per_hour' => [ 'quota' => 100, 'remaining' => 99, 'resetAfter' => 1 ],
     *    'per_day'  => [ 'quota' => 300, 'remaining' => 299, 'resetAfter' => 1 ]
     * ].
     *
     * @param string $rawValue
     *
     * @return array<string,array{quota:null|int,remaining:null|int,resetAfter:null|int}>
     */
    public static function parseQuotaBuckets(string $rawValue): array
    {
        $result = [];

        // Example: "b=per_hour;q=100;r=99;t=1,b=per_day;q=300;r=299;t=1"
        $buckets = explode(',', $rawValue);

        foreach ($buckets as $bucket) {
            $pairs = explode(';', $bucket);

            $bucketName = null;
            $bucketData = [
                'quota' => null,
                'remaining' => null,
                'resetAfter' => null,
            ];

            foreach ($pairs as $pair) {
                $rawParts = explode('=', $pair, 2) + [null, null];
                $parts = array_map(
                    /** @param null|string $v */
                    static fn (?string $v): string => null !== $v ? trim($v) : '',
                    $rawParts,
                );
                $key = $parts[0];
                $value = $parts[1] ?? null;

                if ('b' === $key) {
                    // e.g. "per_hour", "per_day", "per_minute", etc.
                    $bucketName = $value;
                } elseif ('q' === $key) {
                    // "quota"
                    if (is_numeric($value)) {
                        $bucketData['quota'] = (int) $value;
                    }
                } elseif ('r' === $key) {
                    // "remaining"
                    if (is_numeric($value)) {
                        $bucketData['remaining'] = (int) $value;
                    }
                } elseif ('t' === $key) {
                    // "resetAfter"
                    if (is_numeric($value)) {
                        $bucketData['resetAfter'] = (int) $value;
                    }
                }
            }

            // If we got a bucket name like "per_hour", store it
            if (null !== $bucketName) {
                $result[$bucketName] = $bucketData;
            }
        }

        // e.g. { "per_hour" => {...}, "per_day" => {...} }
        return $result;
    }

    /**
     * Parse Auth0's quota headers into the desired 'client'/'organization' structure.
     * The returned array looks like:
     * [
     *   'client' => [
     *       'per_hour' => [ 'quota' => ..., 'remaining' => ..., 'resetAfter' => ... ],
     *       'per_day'  => [ 'quota' => ..., 'remaining' => ..., 'resetAfter' => ... ],
     *   ],
     *   'organization' => [
     *       'per_hour' => [...],
     *       'per_day'  => [...],
     *   ]
     * ].
     *
     * Buckets or keys missing from the header won't appear in the array.
     *
     * @param ResponseInterface $response a ResponseInterface instance to extract from
     *
     * @return array{
     *   client?: array<string,array{quota:int|null,remaining:int|null,resetAfter:int|null}>,
     *   organization?: array<string,array{quota:int|null,remaining:int|null,resetAfter:int|null}>,
     *   retryAfter?: int,
     *   rateLimit?: array{limit?:int,remaining?:int,reset?:int}
     * }
     */
    public static function parseQuotaHeaders(ResponseInterface $response): array
    {
        // Retrieve the raw header strings (they might be arrays of strings from getHeaders()).
        $headers = array_change_key_case($response->getHeaders(), CASE_LOWER);
        $clientLimit = $headers['auth0-client-quota-limit'][0] ?? null;
        $orgLimit = $headers['auth0-organization-quota-limit'][0] ?? null;
        $retryAfteValue = $headers['retry-after'][0] ?? null;

        $client = null !== $clientLimit && '' !== $clientLimit ? self::parseQuotaBuckets($clientLimit) : [];
        $org = null !== $orgLimit && '' !== $orgLimit ? self::parseQuotaBuckets($orgLimit) : [];
        $retryAfter = (is_numeric($retryAfteValue)) ? (int) $retryAfteValue : null;

        $result = [];
        if ([] !== $client) {
            $result['client'] = $client;
        }
        if ([] !== $org) {
            $result['organization'] = $org;
        }
        if (null !== $retryAfter) {
            $result['retryAfter'] = $retryAfter;

            $limitRaw = $headers['x-ratelimit-limit'][0] ?? null;
            $remainingRaw = $headers['x-ratelimit-remaining'][0] ?? null;
            $resetRaw = $headers['x-ratelimit-reset'][0] ?? null;

            $rateLimit = [];
            if (is_numeric($limitRaw)) {
                $rateLimit['limit'] = (int) $limitRaw;
            }
            if (is_numeric($remainingRaw)) {
                $rateLimit['remaining'] = (int) $remainingRaw;
            }
            if (is_numeric($resetRaw)) {
                $rateLimit['reset'] = (int) $resetRaw;
            }

            if ([] !== $rateLimit) {
                $result['rateLimit'] = $rateLimit;
            }
        }

        return $result;
    }

    /**
     * Returns true when the ResponseInterface identifies a 200 status code; otherwise false.
     *
     * @param ResponseInterface $response           a ResponseInterface instance to extract from
     * @param int               $expectedStatusCode Optional. The status code expected to consider the request successful. Defaults to 200.
     */
    public static function wasSuccessful(
        ResponseInterface $response,
        int $expectedStatusCode = 200,
    ): bool {
        return $response->getStatusCode() === $expectedStatusCode;
    }
}
