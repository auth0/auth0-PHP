<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Configuration specific to a webhook destination.
 */
class EventStreamWebhookConfiguration extends JsonSerializableType
{
    /**
     * @var string $webhookEndpoint Target HTTP endpoint URL.
     */
    #[JsonProperty('webhook_endpoint')]
    private string $webhookEndpoint;

    /**
     * @var (
     *    EventStreamWebhookBasicAuth
     *   |EventStreamWebhookBearerAuth
     *   |EventStreamWebhookCustomHeaderAuth
     * ) $webhookAuthorization
     */
    #[JsonProperty('webhook_authorization'), Union(EventStreamWebhookBasicAuth::class, EventStreamWebhookBearerAuth::class, EventStreamWebhookCustomHeaderAuth::class)]
    private EventStreamWebhookBasicAuth|EventStreamWebhookBearerAuth|EventStreamWebhookCustomHeaderAuth $webhookAuthorization;

    /**
     * @param array{
     *   webhookEndpoint: string,
     *   webhookAuthorization: (
     *    EventStreamWebhookBasicAuth
     *   |EventStreamWebhookBearerAuth
     *   |EventStreamWebhookCustomHeaderAuth
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->webhookEndpoint = $values['webhookEndpoint'];
        $this->webhookAuthorization = $values['webhookAuthorization'];
    }

    /**
     * @return string
     */
    public function getWebhookEndpoint(): string
    {
        return $this->webhookEndpoint;
    }

    /**
     * @param string $value
     */
    public function setWebhookEndpoint(string $value): self
    {
        $this->webhookEndpoint = $value;
        $this->_setField('webhookEndpoint');
        return $this;
    }

    /**
     * @return (
     *    EventStreamWebhookBasicAuth
     *   |EventStreamWebhookBearerAuth
     *   |EventStreamWebhookCustomHeaderAuth
     * )
     */
    public function getWebhookAuthorization(): EventStreamWebhookBasicAuth|EventStreamWebhookBearerAuth|EventStreamWebhookCustomHeaderAuth
    {
        return $this->webhookAuthorization;
    }

    /**
     * @param (
     *    EventStreamWebhookBasicAuth
     *   |EventStreamWebhookBearerAuth
     *   |EventStreamWebhookCustomHeaderAuth
     * ) $value
     */
    public function setWebhookAuthorization(EventStreamWebhookBasicAuth|EventStreamWebhookBearerAuth|EventStreamWebhookCustomHeaderAuth $value): self
    {
        $this->webhookAuthorization = $value;
        $this->_setField('webhookAuthorization');
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
