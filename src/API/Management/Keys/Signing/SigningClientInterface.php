<?php

namespace Auth0\SDK\API\Management\Keys\Signing;

use Auth0\SDK\API\Management\Types\SigningKeys;
use Auth0\SDK\API\Management\Types\RotateSigningKeysResponseContent;
use Auth0\SDK\API\Management\Types\GetSigningKeysResponseContent;
use Auth0\SDK\API\Management\Types\RevokedSigningKeysResponseContent;

interface SigningClientInterface
{
    /**
     * Retrieve details of all the application signing keys associated with your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<SigningKeys>
     */
    public function list(?array $options = null): ?array;

    /**
     * Rotate the application signing key of your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RotateSigningKeysResponseContent
     */
    public function rotate(?array $options = null): ?RotateSigningKeysResponseContent;

    /**
     * Retrieve details of the application signing key with the given ID.
     *
     * @param string $kid Key id of the key to retrieve
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetSigningKeysResponseContent
     */
    public function get(string $kid, ?array $options = null): ?GetSigningKeysResponseContent;

    /**
     * Revoke the application signing key with the given ID.
     *
     * @param string $kid Key id of the key to revoke
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RevokedSigningKeysResponseContent
     */
    public function revoke(string $kid, ?array $options = null): ?RevokedSigningKeysResponseContent;
}
