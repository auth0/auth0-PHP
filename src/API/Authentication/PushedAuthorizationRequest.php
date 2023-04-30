<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Authentication;

use Auth0\SDK\Contract\API\Authentication\PushedAuthorizationRequestInterface;
use Auth0\SDK\Contract\API\AuthenticationInterface;
use Auth0\SDK\Exception\Authentication\ParResponseException;
use Auth0\SDK\Exception\{ConfigurationException, NetworkException};
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

use function is_array;
use function is_int;
use function is_string;

final class PushedAuthorizationRequest implements PushedAuthorizationRequestInterface
{
    /**
     * @param AuthenticationInterface $authentication A configured instance of the Authentication manager class.
     */
    public function __construct(
        private AuthenticationInterface $authentication,
    ) {
    }

    public function create(
        ?array $parameters = null,
        ?array $headers = null,
    ): string {
        $httpResponse = $this->post($parameters, $headers);

        if (201 !== $httpResponse->getStatusCode()) {
            throw new NetworkException(sprintf(NetworkException::MSG_NETWORK_REQUEST_FAILED, $httpResponse->getStatusCode()));
        }

        $response = json_decode((string) $httpResponse->getBody(), true, 512);

        $parRequestUri = is_array($response) ? $response['request_uri'] ?? null : null;
        $parExpiresIn = is_array($response) ? $response['expires_in'] ?? null : null;

        if (! is_string($parRequestUri) || ! is_int($parExpiresIn)) {
            throw new ParResponseException(response: $httpResponse, request: $this->authentication->getHttpClient()->getLastRequest()?->getLastRequest());
        }

        return sprintf(
            '%s/authorize?%s',
            $this->authentication->getConfiguration()->formatDomain(),
            http_build_query([
                'client_id' => $parameters['client_id'] ?? $this->authentication->getConfiguration()->getClientId(ConfigurationException::requiresClientId()),
                'request_uri' => $parRequestUri,
            ], '', '&', PHP_QUERY_RFC3986),
        );
    }

    public function post(
        ?array $parameters = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$parameters, $headers] = Toolkit::filter([$parameters, $headers])->array()->trim();

        $parameters = Toolkit::merge([[
            'audience' => $this->authentication->getConfiguration()->defaultAudience(),
            'organization' => $this->authentication->getConfiguration()->defaultOrganization(),
            'response_mode' => $this->authentication->getConfiguration()->getResponseMode(),
            'response_type' => $this->authentication->getConfiguration()->getResponseType(),
            'redirect_uri' => $this->authentication->getConfiguration()->getRedirectUri(),
            'scope' => $this->authentication->getConfiguration()->formatScope(),
        ], $parameters]);

        $parameters = $this->authentication->addClientAuthentication($parameters);

        /** @var array<bool|int|string> $parameters */
        /** @var array<int|string> $headers */

        return $this->authentication->getHttpClient()
            ->method('post')
            ->addPath(['oauth', 'par'])
            ->withHeaders($headers)
            ->withFormParams($parameters)
            ->call();
    }
}
