<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

/**
 * Class MockDataset.
 */
class MockDataset
{
    /**
     * Return a dynamically generated array suitable to represent a mocked state for CookieStore testing.
     *
     * @return array<mixed>
     */
    public static function state(
        int $depth = 0
    ): array {
        $response = [];
        $types = ['string', 'integer', 'float', 'boolean', 'array', 'object', 'null'];
        $childCount = random_int(count($types), count($types) * 2);

        for ($k = 0; $k < $childCount; $k++) {
            $type = $types[random_int(0, count($types) - 1)];
            $name = (string) hash('sha256', bin2hex(random_bytes(random_int(5, 100))));

            if ($type === 'string') {
                $response[$name] = (string) bin2hex(random_bytes(random_int(5, 100)));
                continue;
            }

            if ($type === 'integer') {
                $response[$name] = (int) random_int(1, 1000);
                continue;
            }

            if ($type === 'float') {
                $response[$name] = (float) mt_rand() / mt_getrandmax();
                continue;
            }

            if ($type === 'boolean') {
                $response[$name] = random_int(0,1) == 1;
                continue;
            }

            if ($type === 'array') {
                if ($depth >= 1) {
                    $response[$name] = [];
                    continue;
                }

                $response[$name] = array_values(self::state($depth + 1));
                continue;
            }

            if ($type === 'object') {
                if ($depth >= 1) {
                    $response[$name] = (object) [];
                    continue;
                }

                $response[$name] = (object) self::state($depth + 1);
                continue;
            }

            if ($type === null) {
                $response[$name] = null;
                continue;
            }
        }

        return $response;
    }
}
