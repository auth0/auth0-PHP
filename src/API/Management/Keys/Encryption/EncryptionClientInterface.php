<?php

namespace Auth0\SDK\API\Management\Keys\Encryption;

use Auth0\SDK\API\Management\Keys\Encryption\Requests\ListEncryptionKeysRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\EncryptionKey;
use Auth0\SDK\API\Management\Keys\Encryption\Requests\CreateEncryptionKeyRequestContent;
use Auth0\SDK\API\Management\Types\CreateEncryptionKeyResponseContent;
use Auth0\SDK\API\Management\Types\GetEncryptionKeyResponseContent;
use Auth0\SDK\API\Management\Keys\Encryption\Requests\ImportEncryptionKeyRequestContent;
use Auth0\SDK\API\Management\Types\ImportEncryptionKeyResponseContent;
use Auth0\SDK\API\Management\Types\CreateEncryptionKeyPublicWrappingResponseContent;

interface EncryptionClientInterface
{
    /**
     * Retrieve details of all the encryption keys associated with your tenant.
     *
     * Example:
     * ```php
     * $client->keys->encryption->list(
     *     new ListEncryptionKeysRequestParameters([
     *         'page' => 1,
     *         'perPage' => 1,
     *         'includeTotals' => true,
     *     ]),
     * );
     * ```
     *
     * @param ListEncryptionKeysRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<EncryptionKey>
     */
    public function list(ListEncryptionKeysRequestParameters $request = new ListEncryptionKeysRequestParameters(), ?array $options = null): Pager;

    /**
     * Create the new, pre-activated encryption key, without the key material.
     *
     * Example:
     * ```php
     * $client->keys->encryption->create(
     *     new CreateEncryptionKeyRequestContent([
     *         'type' => CreateEncryptionKeyType::CustomerProvidedRootKey->value,
     *     ]),
     * );
     * ```
     *
     * @param CreateEncryptionKeyRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateEncryptionKeyResponseContent
     */
    public function create(CreateEncryptionKeyRequestContent $request, ?array $options = null): ?CreateEncryptionKeyResponseContent;

    /**
     * Perform rekeying operation on the key hierarchy.
     *
     * Example:
     * ```php
     * $client->keys->encryption->rekey();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function rekey(?array $options = null): void;

    /**
     * Retrieve details of the encryption key with the given ID.
     *
     * Example:
     * ```php
     * $client->keys->encryption->get(
     *     'kid',
     * );
     * ```
     *
     * @param string $kid Encryption key ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetEncryptionKeyResponseContent
     */
    public function get(string $kid, ?array $options = null): ?GetEncryptionKeyResponseContent;

    /**
     * Import wrapped key material and activate encryption key.
     *
     * Example:
     * ```php
     * $client->keys->encryption->import(
     *     'kid',
     *     new ImportEncryptionKeyRequestContent([
     *         'wrappedKey' => 'wrapped_key',
     *     ]),
     * );
     * ```
     *
     * @param string $kid Encryption key ID
     * @param ImportEncryptionKeyRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ImportEncryptionKeyResponseContent
     */
    public function import(string $kid, ImportEncryptionKeyRequestContent $request, ?array $options = null): ?ImportEncryptionKeyResponseContent;

    /**
     * Delete the custom provided encryption key with the given ID and move back to using native encryption key.
     *
     * Example:
     * ```php
     * $client->keys->encryption->delete(
     *     'kid',
     * );
     * ```
     *
     * @param string $kid Encryption key ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $kid, ?array $options = null): void;

    /**
     * Create the public wrapping key to wrap your own encryption key material.
     *
     * Example:
     * ```php
     * $client->keys->encryption->createPublicWrappingKey(
     *     'kid',
     * );
     * ```
     *
     * @param string $kid Encryption key ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateEncryptionKeyPublicWrappingResponseContent
     */
    public function createPublicWrappingKey(string $kid, ?array $options = null): ?CreateEncryptionKeyPublicWrappingResponseContent;
}
