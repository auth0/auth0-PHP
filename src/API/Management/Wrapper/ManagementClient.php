<?php

namespace Auth0\SDK\API\Management\Wrapper;

use Auth0\SDK\API\Management\Actions\ActionsClient;
use Auth0\SDK\API\Management\Anomaly\AnomalyClient;
use Auth0\SDK\API\Management\AttackProtection\AttackProtectionClient;
use Auth0\SDK\API\Management\Branding\BrandingClient;
use Auth0\SDK\API\Management\ClientGrants\ClientGrantsClient;
use Auth0\SDK\API\Management\Clients\ClientsClient;
use Auth0\SDK\API\Management\ConnectionProfiles\ConnectionProfilesClient;
use Auth0\SDK\API\Management\Connections\ConnectionsClient;
use Auth0\SDK\API\Management\CustomDomains\CustomDomainsClient;
use Auth0\SDK\API\Management\DeviceCredentials\DeviceCredentialsClient;
use Auth0\SDK\API\Management\EmailTemplates\EmailTemplatesClient;
use Auth0\SDK\API\Management\Emails\EmailsClient;
use Auth0\SDK\API\Management\EventStreams\EventStreamsClient;
use Auth0\SDK\API\Management\Flows\FlowsClient;
use Auth0\SDK\API\Management\Forms\FormsClient;
use Auth0\SDK\API\Management\Guardian\GuardianClient;
use Auth0\SDK\API\Management\Hooks\HooksClient;
use Auth0\SDK\API\Management\Jobs\JobsClient;
use Auth0\SDK\API\Management\Keys\KeysClient;
use Auth0\SDK\API\Management\LogStreams\LogStreamsClient;
use Auth0\SDK\API\Management\Logs\LogsClient;
use Auth0\SDK\API\Management as ApiManagement;
use Auth0\SDK\API\Management\NetworkAcls\NetworkAclsClient;
use Auth0\SDK\API\Management\Organizations\OrganizationsClient;
use Auth0\SDK\API\Management\Prompts\PromptsClient;
use Auth0\SDK\API\Management\RefreshTokens\RefreshTokensClient;
use Auth0\SDK\API\Management\ResourceServers\ResourceServersClient;
use Auth0\SDK\API\Management\RiskAssessments\RiskAssessmentsClient;
use Auth0\SDK\API\Management\Roles\RolesClient;
use Auth0\SDK\API\Management\Rules\RulesClient;
use Auth0\SDK\API\Management\RulesConfigs\RulesConfigsClient;
use Auth0\SDK\API\Management\SelfServiceProfiles\SelfServiceProfilesClient;
use Auth0\SDK\API\Management\Sessions\SessionsClient;
use Auth0\SDK\API\Management\Stats\StatsClient;
use Auth0\SDK\API\Management\SupplementalSignals\SupplementalSignalsClient;
use Auth0\SDK\API\Management\Tenants\TenantsClient;
use Auth0\SDK\API\Management\Tickets\TicketsClient;
use Auth0\SDK\API\Management\TokenExchangeProfiles\TokenExchangeProfilesClient;
use Auth0\SDK\API\Management\UserAttributeProfiles\UserAttributeProfilesClient;
use Auth0\SDK\API\Management\UserBlocks\UserBlocksClient;
use Auth0\SDK\API\Management\UserGrants\UserGrantsClient;
use Auth0\SDK\API\Management\Users\UsersClient;
use Auth0\SDK\API\Management\VerifiableCredentials\VerifiableCredentialsClient;
use Auth0\SDK\API\Management\Core\Client\HttpClientBuilder;
use Auth0\SDK\Auth0;
use InvalidArgumentException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Domain-based Management API client with automatic token management.
 *
 * Wraps the generated {@see Management} client to provide:
 * - Automatic OAuth 2.0 client credentials token acquisition and caching
 * - Support for static tokens or custom token provider callables
 * - Transparent access to all Management API domain sub-clients
 *
 * @property-read ActionsClient $actions
 * @property-read AnomalyClient $anomaly
 * @property-read AttackProtectionClient $attackProtection
 * @property-read BrandingClient $branding
 * @property-read ClientGrantsClient $clientGrants
 * @property-read ClientsClient $clients
 * @property-read ConnectionProfilesClient $connectionProfiles
 * @property-read ConnectionsClient $connections
 * @property-read CustomDomainsClient $customDomains
 * @property-read DeviceCredentialsClient $deviceCredentials
 * @property-read EmailsClient $emails
 * @property-read EmailTemplatesClient $emailTemplates
 * @property-read EventStreamsClient $eventStreams
 * @property-read FlowsClient $flows
 * @property-read FormsClient $forms
 * @property-read GuardianClient $guardian
 * @property-read HooksClient $hooks
 * @property-read JobsClient $jobs
 * @property-read KeysClient $keys
 * @property-read LogsClient $logs
 * @property-read LogStreamsClient $logStreams
 * @property-read NetworkAclsClient $networkAcls
 * @property-read OrganizationsClient $organizations
 * @property-read PromptsClient $prompts
 * @property-read RefreshTokensClient $refreshTokens
 * @property-read ResourceServersClient $resourceServers
 * @property-read RiskAssessmentsClient $riskAssessments
 * @property-read RolesClient $roles
 * @property-read RulesClient $rules
 * @property-read RulesConfigsClient $rulesConfigs
 * @property-read SelfServiceProfilesClient $selfServiceProfiles
 * @property-read SessionsClient $sessions
 * @property-read StatsClient $stats
 * @property-read SupplementalSignalsClient $supplementalSignals
 * @property-read TenantsClient $tenants
 * @property-read TicketsClient $tickets
 * @property-read TokenExchangeProfilesClient $tokenExchangeProfiles
 * @property-read UserAttributeProfilesClient $userAttributeProfiles
 * @property-read UserBlocksClient $userBlocks
 * @property-read UserGrantsClient $userGrants
 * @property-read UsersClient $users
 * @property-read VerifiableCredentialsClient $verifiableCredentials
 */
final class ManagementClient
{
    private ApiManagement $management;

    public function __construct(ManagementClientOptions $options)
    {
        $tokenSupplier = $this->buildTokenSupplier($options);

        $baseUrl = "https://{$options->domain}/api/v2";

        $client = $this->buildHttpClient($tokenSupplier, $options->httpClient);

        $managementOptions = [
            'baseUrl' => $baseUrl,
            'client' => $client,
        ];

        if ($options->timeout !== null) {
            $managementOptions['timeout'] = $options->timeout;
        }

        if ($options->maxRetries !== null) {
            $managementOptions['maxRetries'] = $options->maxRetries;
        }

        $telemetryHeaders = [
            'User-Agent' => 'auth0-php/' . Auth0::VERSION,
            'Auth0-Client' => base64_encode(json_encode([
                'name' => 'auth0-php',
                'version' => Auth0::VERSION,
                'env' => ['php' => PHP_VERSION],
            ], JSON_THROW_ON_ERROR)),
        ];

        $managementOptions['headers'] = array_merge(
            $telemetryHeaders,
            $options->additionalHeaders ?? [],
        );

        /** @phpstan-ignore argument.type */
        $this->management = new ApiManagement('', $managementOptions);
    }

    /**
     * Build a PSR-18 decorating client that injects the Authorization header dynamically.
     *
     * @param callable(): string $tokenSupplier
     */
    private function buildHttpClient(callable $tokenSupplier, ?ClientInterface $baseClient): ClientInterface
    {
        $inner = $baseClient ?? HttpClientBuilder::baseClient();

        return new class($inner, $tokenSupplier) implements ClientInterface {
            /** @var callable(): string */
            private $tokenSupplier;

            /** @param callable(): string $tokenSupplier */
            public function __construct(
                private readonly ClientInterface $inner,
                callable $tokenSupplier,
            ) {
                $this->tokenSupplier = $tokenSupplier;
            }

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                $request = $request->withHeader('Authorization', 'Bearer ' . ($this->tokenSupplier)());
                return $this->inner->sendRequest($request);
            }
        };
    }

    /**
     * Return the underlying generated Management client (with token-injecting HTTP decorator).
     */
    public function getManagement(): ApiManagement
    {
        return $this->management;
    }

    public function __get(string $name): mixed
    {
        /** @phpstan-ignore property.dynamicName */
        return $this->management->{$name};
    }

    public function __isset(string $name): bool
    {
        /** @phpstan-ignore property.dynamicName */
        return isset($this->management->{$name});
    }

    /**
     * @return callable(): string
     */
    private function buildTokenSupplier(ManagementClientOptions $options): callable
    {
        $tokenProvider = $options->getTokenProvider();
        if ($tokenProvider !== null) {
            return $tokenProvider;
        }

        if ($options->token !== null) {
            $token = $options->token;
            return static fn (): string => $token;
        }

        if ($options->clientId !== null && $options->clientSecret !== null) {
            $audience = $options->audience ?? "https://{$options->domain}/api/v2/";
            $provider = new TokenProvider(
                $options->domain,
                $options->clientId,
                $options->clientSecret,
                $audience,
                $options->httpClient,
                $options->tokenCache,
            );
            return [$provider, 'getToken'];
        }

        if ($options->clientId !== null || $options->clientSecret !== null) {
            throw new InvalidArgumentException(
                'Both clientId and clientSecret must be provided together.'
            );
        }

        throw new InvalidArgumentException(
            'At least one of token, tokenProvider, or clientId+clientSecret must be provided.'
        );
    }
}
