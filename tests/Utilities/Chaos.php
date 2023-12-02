<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

class Chaos
{
    public static function corruptString(
        string $original,
        int $iterations = 1
    ): string {
        $len = strlen($original);

        for ($i = 0; $i < $iterations; $i++) {
            $random = random_int(0, $len - 1);
            $corrupted = substr_replace($original, chr(random_int(0, 255)), $random, 1);
        }

        if ($original === $corrupted) {
            return self::corruptString($original, $iterations);
        }

        return $corrupted;
    }
}
