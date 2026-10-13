<?php

namespace Auth0\SDK\API\Management\AttackProtection\CaptchaPolicies;

use Auth0\SDK\API\Management\Types\AttackProtectionCaptchaPolicy;
use Auth0\SDK\API\Management\AttackProtection\CaptchaPolicies\Requests\CreateAttackProtectionCaptchaPolicyRequestContent;
use Auth0\SDK\API\Management\AttackProtection\CaptchaPolicies\Requests\UpdateAttackProtectionCaptchaPolicyRequestContent;

interface CaptchaPoliciesClientInterface
{
    /**
     * Retrieve all CAPTCHA attack protection policies for the tenant, sorted by priority ascending.
     *
     * Example:
     * ```php
     * $client->attackProtection->captchaPolicies->list();
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
     * @return ?array<AttackProtectionCaptchaPolicy>
     */
    public function list(?array $options = null): ?array;

    /**
     * Create a new CAPTCHA attack protection policy for the tenant. The maximum number of policies per tenant is determined by the tenant's subscription.
     *
     * Example:
     * ```php
     * $client->attackProtection->captchaPolicies->create(
     *     new CreateAttackProtectionCaptchaPolicyRequestContent([
     *         'name' => 'name',
     *         'priority' => 1,
     *         'match' => new AttackProtectionCaptchaPolicyMatch([]),
     *         'action' => new AttackProtectionCaptchaPolicyActionInput([]),
     *     ]),
     * );
     * ```
     *
     * @param CreateAttackProtectionCaptchaPolicyRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AttackProtectionCaptchaPolicy
     */
    public function create(CreateAttackProtectionCaptchaPolicyRequestContent $request, ?array $options = null): ?AttackProtectionCaptchaPolicy;

    /**
     * Retrieve a single CAPTCHA attack protection policy for the tenant by ID.
     *
     * Example:
     * ```php
     * $client->attackProtection->captchaPolicies->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the CAPTCHA attack protection policy.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AttackProtectionCaptchaPolicy
     */
    public function get(string $id, ?array $options = null): ?AttackProtectionCaptchaPolicy;

    /**
     * Delete a CAPTCHA attack protection policy for the tenant.
     *
     * Example:
     * ```php
     * $client->attackProtection->captchaPolicies->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the CAPTCHA attack protection policy.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;

    /**
     * Partially update a CAPTCHA attack protection policy. Only the provided fields are modified. A provided match or action replaces the stored value in full rather than merging with it; within action, a provider secret or API key that is omitted from a provided provider block keeps its stored value.
     *
     * Example:
     * ```php
     * $client->attackProtection->captchaPolicies->update(
     *     'id',
     *     new UpdateAttackProtectionCaptchaPolicyRequestContent([]),
     * );
     * ```
     *
     * @param string $id ID of the CAPTCHA attack protection policy.
     * @param UpdateAttackProtectionCaptchaPolicyRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AttackProtectionCaptchaPolicy
     */
    public function update(string $id, UpdateAttackProtectionCaptchaPolicyRequestContent $request = new UpdateAttackProtectionCaptchaPolicyRequestContent(), ?array $options = null): ?AttackProtectionCaptchaPolicy;
}
