<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class NetworkAclMatch extends JsonSerializableType
{
    /**
     * @var ?array<int> $asns
     */
    #[JsonProperty('asns'), ArrayType(['integer'])]
    private ?array $asns;

    /**
     * @var ?array<string> $geoCountryCodes
     */
    #[JsonProperty('geo_country_codes'), ArrayType(['string'])]
    private ?array $geoCountryCodes;

    /**
     * @var ?array<string> $geoSubdivisionCodes
     */
    #[JsonProperty('geo_subdivision_codes'), ArrayType(['string'])]
    private ?array $geoSubdivisionCodes;

    /**
     * @var ?array<string> $ipv4Cidrs
     */
    #[JsonProperty('ipv4_cidrs'), ArrayType(['string'])]
    private ?array $ipv4Cidrs;

    /**
     * @var ?array<string> $ipv6Cidrs
     */
    #[JsonProperty('ipv6_cidrs'), ArrayType(['string'])]
    private ?array $ipv6Cidrs;

    /**
     * @var ?array<string> $ja3Fingerprints
     */
    #[JsonProperty('ja3_fingerprints'), ArrayType(['string'])]
    private ?array $ja3Fingerprints;

    /**
     * @var ?array<string> $ja4Fingerprints
     */
    #[JsonProperty('ja4_fingerprints'), ArrayType(['string'])]
    private ?array $ja4Fingerprints;

    /**
     * @var ?array<string> $userAgents
     */
    #[JsonProperty('user_agents'), ArrayType(['string'])]
    private ?array $userAgents;

    /**
     * @var ?array<string> $hostnames
     */
    #[JsonProperty('hostnames'), ArrayType(['string'])]
    private ?array $hostnames;

    /**
     * @var ?array<string> $connectingIpv4Cidrs
     */
    #[JsonProperty('connecting_ipv4_cidrs'), ArrayType(['string'])]
    private ?array $connectingIpv4Cidrs;

    /**
     * @var ?array<string> $connectingIpv6Cidrs
     */
    #[JsonProperty('connecting_ipv6_cidrs'), ArrayType(['string'])]
    private ?array $connectingIpv6Cidrs;

    /**
     * @param array{
     *   asns?: ?array<int>,
     *   geoCountryCodes?: ?array<string>,
     *   geoSubdivisionCodes?: ?array<string>,
     *   ipv4Cidrs?: ?array<string>,
     *   ipv6Cidrs?: ?array<string>,
     *   ja3Fingerprints?: ?array<string>,
     *   ja4Fingerprints?: ?array<string>,
     *   userAgents?: ?array<string>,
     *   hostnames?: ?array<string>,
     *   connectingIpv4Cidrs?: ?array<string>,
     *   connectingIpv6Cidrs?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->asns = $values['asns'] ?? null;
        $this->geoCountryCodes = $values['geoCountryCodes'] ?? null;
        $this->geoSubdivisionCodes = $values['geoSubdivisionCodes'] ?? null;
        $this->ipv4Cidrs = $values['ipv4Cidrs'] ?? null;
        $this->ipv6Cidrs = $values['ipv6Cidrs'] ?? null;
        $this->ja3Fingerprints = $values['ja3Fingerprints'] ?? null;
        $this->ja4Fingerprints = $values['ja4Fingerprints'] ?? null;
        $this->userAgents = $values['userAgents'] ?? null;
        $this->hostnames = $values['hostnames'] ?? null;
        $this->connectingIpv4Cidrs = $values['connectingIpv4Cidrs'] ?? null;
        $this->connectingIpv6Cidrs = $values['connectingIpv6Cidrs'] ?? null;
    }

    /**
     * @return ?array<int>
     */
    public function getAsns(): ?array
    {
        return $this->asns;
    }

    /**
     * @param ?array<int> $value
     */
    public function setAsns(?array $value = null): self
    {
        $this->asns = $value;
        $this->_setField('asns');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getGeoCountryCodes(): ?array
    {
        return $this->geoCountryCodes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setGeoCountryCodes(?array $value = null): self
    {
        $this->geoCountryCodes = $value;
        $this->_setField('geoCountryCodes');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getGeoSubdivisionCodes(): ?array
    {
        return $this->geoSubdivisionCodes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setGeoSubdivisionCodes(?array $value = null): self
    {
        $this->geoSubdivisionCodes = $value;
        $this->_setField('geoSubdivisionCodes');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getIpv4Cidrs(): ?array
    {
        return $this->ipv4Cidrs;
    }

    /**
     * @param ?array<string> $value
     */
    public function setIpv4Cidrs(?array $value = null): self
    {
        $this->ipv4Cidrs = $value;
        $this->_setField('ipv4Cidrs');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getIpv6Cidrs(): ?array
    {
        return $this->ipv6Cidrs;
    }

    /**
     * @param ?array<string> $value
     */
    public function setIpv6Cidrs(?array $value = null): self
    {
        $this->ipv6Cidrs = $value;
        $this->_setField('ipv6Cidrs');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getJa3Fingerprints(): ?array
    {
        return $this->ja3Fingerprints;
    }

    /**
     * @param ?array<string> $value
     */
    public function setJa3Fingerprints(?array $value = null): self
    {
        $this->ja3Fingerprints = $value;
        $this->_setField('ja3Fingerprints');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getJa4Fingerprints(): ?array
    {
        return $this->ja4Fingerprints;
    }

    /**
     * @param ?array<string> $value
     */
    public function setJa4Fingerprints(?array $value = null): self
    {
        $this->ja4Fingerprints = $value;
        $this->_setField('ja4Fingerprints');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getUserAgents(): ?array
    {
        return $this->userAgents;
    }

    /**
     * @param ?array<string> $value
     */
    public function setUserAgents(?array $value = null): self
    {
        $this->userAgents = $value;
        $this->_setField('userAgents');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getHostnames(): ?array
    {
        return $this->hostnames;
    }

    /**
     * @param ?array<string> $value
     */
    public function setHostnames(?array $value = null): self
    {
        $this->hostnames = $value;
        $this->_setField('hostnames');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getConnectingIpv4Cidrs(): ?array
    {
        return $this->connectingIpv4Cidrs;
    }

    /**
     * @param ?array<string> $value
     */
    public function setConnectingIpv4Cidrs(?array $value = null): self
    {
        $this->connectingIpv4Cidrs = $value;
        $this->_setField('connectingIpv4Cidrs');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getConnectingIpv6Cidrs(): ?array
    {
        return $this->connectingIpv6Cidrs;
    }

    /**
     * @param ?array<string> $value
     */
    public function setConnectingIpv6Cidrs(?array $value = null): self
    {
        $this->connectingIpv6Cidrs = $value;
        $this->_setField('connectingIpv6Cidrs');
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
