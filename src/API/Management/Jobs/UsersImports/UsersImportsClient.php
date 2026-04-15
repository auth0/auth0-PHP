<?php

namespace Auth0\SDK\API\Management\Jobs\UsersImports;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Jobs\UsersImports\Requests\CreateImportUsersRequestContent;
use Auth0\SDK\API\Management\Types\CreateImportUsersResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Multipart\MultipartFormData;
use Auth0\SDK\API\Management\Core\Multipart\MultipartApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class UsersImportsClient implements UsersImportsClientInterface
{
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
    }

    /**
     * Import users from a <a href="https://auth0.com/docs/users/references/bulk-import-database-schema-examples">formatted file</a> into a connection via a long-running job. When importing users, with or without upsert, the `email_verified` is set to `false` when the email address is added or updated. Users must verify their email address. To avoid this behavior, set `email_verified` to `true` in the imported data.
     *
     * @param CreateImportUsersRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     * } $options
     * @return ?CreateImportUsersResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateImportUsersRequestContent $request, ?array $options = null): ?CreateImportUsersResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $body = new MultipartFormData();
        $body->addPart($request->getUsers()->toMultipartFormDataPart('users'));
        $body->add(name: 'connection_id', value: $request->getConnectionId());
        if ($request->getUpsert() != null) {
            $body->add(name: 'upsert', value: $request->getUpsert());
        }
        if ($request->getExternalId() != null) {
            $body->add(name: 'external_id', value: $request->getExternalId());
        }
        if ($request->getSendCompletionEmail() != null) {
            $body->add(name: 'send_completion_email', value: $request->getSendCompletionEmail());
        }
        try {
            $response = $this->client->sendRequest(
                new MultipartApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "jobs/users-imports",
                    method: HttpMethod::POST,
                    body: $body,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return CreateImportUsersResponseContent::fromJson($json);
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
}
