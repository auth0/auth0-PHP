<?php

namespace Auth0\SDK\API\Management\Jobs;

use Auth0\SDK\API\Management\Jobs\UsersExports\UsersExportsClient;
use Auth0\SDK\API\Management\Jobs\UsersImports\UsersImportsClient;
use Auth0\SDK\API\Management\Jobs\VerificationEmail\VerificationEmailClient;
use Auth0\SDK\API\Management\Jobs\Errors\ErrorsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Types\GetJobResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Jobs\UsersExports\UsersExportsClientInterface;
use Auth0\SDK\API\Management\Jobs\UsersImports\UsersImportsClientInterface;
use Auth0\SDK\API\Management\Jobs\VerificationEmail\VerificationEmailClientInterface;
use Auth0\SDK\API\Management\Jobs\Errors\ErrorsClientInterface;

class JobsClient implements JobsClientInterface
{
    /**
     * @var UsersExportsClient $usersExports
     */
    public UsersExportsClient $usersExports;

    /**
     * @var UsersImportsClient $usersImports
     */
    public UsersImportsClient $usersImports;

    /**
     * @var VerificationEmailClient $verificationEmail
     */
    public VerificationEmailClient $verificationEmail;

    /**
     * @var ErrorsClient $errors
     */
    public ErrorsClient $errors;

    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
        $this->usersExports = new UsersExportsClient($this->client, $this->options);
        $this->usersImports = new UsersImportsClient($this->client, $this->options);
        $this->verificationEmail = new VerificationEmailClient($this->client, $this->options);
        $this->errors = new ErrorsClient($this->client, $this->options);
    }

    /**
     * Retrieves a job. Useful to check its status.
     *
     * @param string $id ID of the job.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetJobResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?GetJobResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "jobs/{$id}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetJobResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * @return UsersExportsClientInterface
     */
    public function getUsersExports(): UsersExportsClientInterface
    {
        return $this->usersExports;
    }

    /**
     * @return UsersImportsClientInterface
     */
    public function getUsersImports(): UsersImportsClientInterface
    {
        return $this->usersImports;
    }

    /**
     * @return VerificationEmailClientInterface
     */
    public function getVerificationEmail(): VerificationEmailClientInterface
    {
        return $this->verificationEmail;
    }

    /**
     * @return ErrorsClientInterface
     */
    public function getErrors(): ErrorsClientInterface
    {
        return $this->errors;
    }
}
