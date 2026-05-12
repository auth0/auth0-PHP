<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * An HTTP request.
 */
class EventStreamCloudEventContextRequest extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventContextRequestGeo $geo
     */
    #[JsonProperty('geo')]
    private EventStreamCloudEventContextRequestGeo $geo;

    /**
     * @var string $hostname The hostname the request is for.
     */
    #[JsonProperty('hostname')]
    private string $hostname;

    /**
     * @var ?string $customDomain The custom domain used in the request (if any).
     */
    #[JsonProperty('custom_domain')]
    private ?string $customDomain;

    /**
     * @var string $ip The originating IP address of the request.
     */
    #[JsonProperty('ip')]
    private string $ip;

    /**
     * @var string $method The HTTP method used for the request.
     */
    #[JsonProperty('method')]
    private string $method;

    /**
     * @var string $userAgent The value of the `User-Agent` header.
     */
    #[JsonProperty('user_agent')]
    private string $userAgent;

    /**
     * @param array{
     *   geo: EventStreamCloudEventContextRequestGeo,
     *   hostname: string,
     *   ip: string,
     *   method: string,
     *   userAgent: string,
     *   customDomain?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->geo = $values['geo'];
        $this->hostname = $values['hostname'];
        $this->customDomain = $values['customDomain'] ?? null;
        $this->ip = $values['ip'];
        $this->method = $values['method'];
        $this->userAgent = $values['userAgent'];
    }

    /**
     * @return EventStreamCloudEventContextRequestGeo
     */
    public function getGeo(): EventStreamCloudEventContextRequestGeo
    {
        return $this->geo;
    }

    /**
     * @param EventStreamCloudEventContextRequestGeo $value
     */
    public function setGeo(EventStreamCloudEventContextRequestGeo $value): self
    {
        $this->geo = $value;
        $this->_setField('geo');
        return $this;
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @param string $value
     */
    public function setHostname(string $value): self
    {
        $this->hostname = $value;
        $this->_setField('hostname');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCustomDomain(): ?string
    {
        return $this->customDomain;
    }

    /**
     * @param ?string $value
     */
    public function setCustomDomain(?string $value = null): self
    {
        $this->customDomain = $value;
        $this->_setField('customDomain');
        return $this;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $value
     */
    public function setIp(string $value): self
    {
        $this->ip = $value;
        $this->_setField('ip');
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $value
     */
    public function setMethod(string $value): self
    {
        $this->method = $value;
        $this->_setField('method');
        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @param string $value
     */
    public function setUserAgent(string $value): self
    {
        $this->userAgent = $value;
        $this->_setField('userAgent');
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
