<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Toolkit;

/**
 * Class Assert.
 */
final class Assert
{
    /**
     * Values to process.
     *
     * @var array<mixed>
     */
    private array $subject;

    /**
     * ArrayProcessor Constructor
     *
     * @param array<mixed> $subject Values to process.
     */
    public function __construct(
        array $subject
    ) {
        $this->subject = $subject;
    }

    /**
     * Check for invalid permissions with an array of permissions.
     *
     * @throws \Exception When subject is not a permissions array or is empty.
     */
    public function isPermissions(): void
    {
        foreach ($this->subject as [$value, $exception]) {
            if (! is_array($value)) {
                throw $exception;
            }

            if (count($value) === 0) {
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
     * @throws \Exception When subject is not a string or is empty.
     */
    public function isString(): void
    {
        foreach ($this->subject as [$value, $exception]) {
            if (! is_string($value)) {
                throw $exception;
            }

            if (mb_strlen($value) === 0) {
                throw $exception;
            }
        }
    }

    /**
     * Check that a variable is a non-empty string that contains a valid email address.
     *
     * @throws \Exception When subject is not a valid email address.
     */
    public function isEmail(): void
    {
        foreach ($this->subject as [$value, $exception]) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                throw $exception;
            }
        }
    }

    /**
     * Check that a variable is an array and is not empty.
     *
     * @throws \Exception When subject is not an array or is empty.
     */
    public function isArray(): void
    {
        foreach ($this->subject as [$value, $exception]) {
            if (! is_array($value)) {
                throw $exception;
            }

            if (count($value) === 0) {
                throw $exception;
            }
        }
    }
}
