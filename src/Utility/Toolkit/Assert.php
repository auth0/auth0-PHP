<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Toolkit;

use Exception;
use Throwable;

use function is_array;
use function is_string;

final class Assert
{
    /**
     * ArrayProcessor Constructor.
     *
     * @param array<array{0: mixed, 1: Throwable}> $subjects values to process
     */
    public function __construct(
        private array $subjects,
    ) {
    }

    /**
     * Check that a variable is an array and is not empty.
     *
     * @throws Exception when subject is not an array or is empty
     */
    public function isArray(): void
    {
        foreach ($this->subjects as [$value, $exception]) {
            if (! is_array($value)) {
                throw $exception;
            }

            if ([] === $value) {
                throw $exception;
            }
        }
    }

    /**
     * Check that a variable is a non-empty string that contains a valid email address.
     *
     * @throws Exception when subject is not a valid email address
     */
    public function isEmail(): void
    {
        foreach ($this->subjects as [$value, $exception]) {
            if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
                throw $exception;
            }
        }
    }

    /**
     * Check for invalid permissions with an array of permissions.
     *
     * @throws Exception when subject is not a permissions array or is empty
     */
    public function isPermissions(): void
    {
        foreach ($this->subjects as [$value, $exception]) {
            if (! is_array($value)) {
                throw $exception;
            }

            if ([] === $value) {
                throw $exception;
            }

            foreach ($value as $permission) {
                if (! isset($permission['permission_name'])) {
                    throw $exception;
                }

                if (! isset($permission['resource_server_identifier'])) {
                    throw $exception;
                }
            }
        }
    }

    /**
     * Check that a variable is a string and is not empty.
     *
     * @throws Exception when subject is not a string or is empty
     */
    public function isString(): void
    {
        foreach ($this->subjects as [$value, $exception]) {
            if (! is_string($value)) {
                throw $exception;
            }

            if (0 === mb_strlen($value)) {
                throw $exception;
            }
        }
    }
}
