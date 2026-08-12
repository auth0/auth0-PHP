<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Information about the context in which the event was produced. This may include things like
 * HTTP request details, client information, connection information, etc.
 *
 * Note: This field may not be present on all events, depending on the event type and the
 * context in which it was generated.
 */
class EventStreamCloudEventContext extends JsonSerializableType
{
    /**
     * @var ?EventStreamCloudEventContextClient $client
     */
    #[JsonProperty('client')]
    private ?EventStreamCloudEventContextClient $client;

    /**
     * @var ?EventStreamCloudEventContextConnection $connection
     */
    #[JsonProperty('connection')]
    private ?EventStreamCloudEventContextConnection $connection;

    /**
     * @var ?EventStreamCloudEventContextRequest $request
     */
    #[JsonProperty('request')]
    private ?EventStreamCloudEventContextRequest $request;

    /**
     * @var EventStreamCloudEventContextTenant $tenant
     */
    #[JsonProperty('tenant')]
    private EventStreamCloudEventContextTenant $tenant;

    /**
     * @param array{
     *   tenant: EventStreamCloudEventContextTenant,
     *   client?: ?EventStreamCloudEventContextClient,
     *   connection?: ?EventStreamCloudEventContextConnection,
     *   request?: ?EventStreamCloudEventContextRequest,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->client = $values['client'] ?? null;
        $this->connection = $values['connection'] ?? null;
        $this->request = $values['request'] ?? null;
        $this->tenant = $values['tenant'];
    }

    /**
     * @return ?EventStreamCloudEventContextClient
     */
    public function getClient(): ?EventStreamCloudEventContextClient
    {
        return $this->client;
    }

    /**
     * @param ?EventStreamCloudEventContextClient $value
     */
    public function setClient(?EventStreamCloudEventContextClient $value = null): self
    {
        $this->client = $value;
        $this->_setField('client');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventContextConnection
     */
    public function getConnection(): ?EventStreamCloudEventContextConnection
    {
        return $this->connection;
    }

    /**
     * @param ?EventStreamCloudEventContextConnection $value
     */
    public function setConnection(?EventStreamCloudEventContextConnection $value = null): self
    {
        $this->connection = $value;
        $this->_setField('connection');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventContextRequest
     */
    public function getRequest(): ?EventStreamCloudEventContextRequest
    {
        return $this->request;
    }

    /**
     * @param ?EventStreamCloudEventContextRequest $value
     */
    public function setRequest(?EventStreamCloudEventContextRequest $value = null): self
    {
        $this->request = $value;
        $this->_setField('request');
        return $this;
    }

    /**
     * @return EventStreamCloudEventContextTenant
     */
    public function getTenant(): EventStreamCloudEventContextTenant
    {
        return $this->tenant;
    }

    /**
     * @param EventStreamCloudEventContextTenant $value
     */
    public function setTenant(EventStreamCloudEventContextTenant $value): self
    {
        $this->tenant = $value;
        $this->_setField('tenant');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
