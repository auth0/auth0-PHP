<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * SAML2 addon indicator (no configuration settings needed for SAML2 addon).
 */
class ClientAddonSaml extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $mappings
     */
    #[JsonProperty('mappings'), ArrayType(['string' => 'mixed'])]
    private ?array $mappings;

    /**
     * @var ?string $audience
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @var ?string $recipient
     */
    #[JsonProperty('recipient')]
    private ?string $recipient;

    /**
     * @var ?bool $createUpnClaim
     */
    #[JsonProperty('createUpnClaim')]
    private ?bool $createUpnClaim;

    /**
     * @var ?bool $mapUnknownClaimsAsIs
     */
    #[JsonProperty('mapUnknownClaimsAsIs')]
    private ?bool $mapUnknownClaimsAsIs;

    /**
     * @var ?bool $passthroughClaimsWithNoMapping
     */
    #[JsonProperty('passthroughClaimsWithNoMapping')]
    private ?bool $passthroughClaimsWithNoMapping;

    /**
     * @var ?bool $mapIdentities
     */
    #[JsonProperty('mapIdentities')]
    private ?bool $mapIdentities;

    /**
     * @var ?string $signatureAlgorithm
     */
    #[JsonProperty('signatureAlgorithm')]
    private ?string $signatureAlgorithm;

    /**
     * @var ?string $digestAlgorithm
     */
    #[JsonProperty('digestAlgorithm')]
    private ?string $digestAlgorithm;

    /**
     * @var ?string $issuer
     */
    #[JsonProperty('issuer')]
    private ?string $issuer;

    /**
     * @var ?string $destination
     */
    #[JsonProperty('destination')]
    private ?string $destination;

    /**
     * @var ?int $lifetimeInSeconds
     */
    #[JsonProperty('lifetimeInSeconds')]
    private ?int $lifetimeInSeconds;

    /**
     * @var ?bool $signResponse
     */
    #[JsonProperty('signResponse')]
    private ?bool $signResponse;

    /**
     * @var ?string $nameIdentifierFormat
     */
    #[JsonProperty('nameIdentifierFormat')]
    private ?string $nameIdentifierFormat;

    /**
     * @var ?array<string> $nameIdentifierProbes
     */
    #[JsonProperty('nameIdentifierProbes'), ArrayType(['string'])]
    private ?array $nameIdentifierProbes;

    /**
     * @var ?string $authnContextClassRef
     */
    #[JsonProperty('authnContextClassRef')]
    private ?string $authnContextClassRef;

    /**
     * @param array{
     *   mappings?: ?array<string, mixed>,
     *   audience?: ?string,
     *   recipient?: ?string,
     *   createUpnClaim?: ?bool,
     *   mapUnknownClaimsAsIs?: ?bool,
     *   passthroughClaimsWithNoMapping?: ?bool,
     *   mapIdentities?: ?bool,
     *   signatureAlgorithm?: ?string,
     *   digestAlgorithm?: ?string,
     *   issuer?: ?string,
     *   destination?: ?string,
     *   lifetimeInSeconds?: ?int,
     *   signResponse?: ?bool,
     *   nameIdentifierFormat?: ?string,
     *   nameIdentifierProbes?: ?array<string>,
     *   authnContextClassRef?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->mappings = $values['mappings'] ?? null;
        $this->audience = $values['audience'] ?? null;
        $this->recipient = $values['recipient'] ?? null;
        $this->createUpnClaim = $values['createUpnClaim'] ?? null;
        $this->mapUnknownClaimsAsIs = $values['mapUnknownClaimsAsIs'] ?? null;
        $this->passthroughClaimsWithNoMapping = $values['passthroughClaimsWithNoMapping'] ?? null;
        $this->mapIdentities = $values['mapIdentities'] ?? null;
        $this->signatureAlgorithm = $values['signatureAlgorithm'] ?? null;
        $this->digestAlgorithm = $values['digestAlgorithm'] ?? null;
        $this->issuer = $values['issuer'] ?? null;
        $this->destination = $values['destination'] ?? null;
        $this->lifetimeInSeconds = $values['lifetimeInSeconds'] ?? null;
        $this->signResponse = $values['signResponse'] ?? null;
        $this->nameIdentifierFormat = $values['nameIdentifierFormat'] ?? null;
        $this->nameIdentifierProbes = $values['nameIdentifierProbes'] ?? null;
        $this->authnContextClassRef = $values['authnContextClassRef'] ?? null;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getMappings(): ?array
    {
        return $this->mappings;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setMappings(?array $value = null): self
    {
        $this->mappings = $value;
        $this->_setField('mappings');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAudience(): ?string
    {
        return $this->audience;
    }

    /**
     * @param ?string $value
     */
    public function setAudience(?string $value = null): self
    {
        $this->audience = $value;
        $this->_setField('audience');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRecipient(): ?string
    {
        return $this->recipient;
    }

    /**
     * @param ?string $value
     */
    public function setRecipient(?string $value = null): self
    {
        $this->recipient = $value;
        $this->_setField('recipient');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCreateUpnClaim(): ?bool
    {
        return $this->createUpnClaim;
    }

    /**
     * @param ?bool $value
     */
    public function setCreateUpnClaim(?bool $value = null): self
    {
        $this->createUpnClaim = $value;
        $this->_setField('createUpnClaim');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getMapUnknownClaimsAsIs(): ?bool
    {
        return $this->mapUnknownClaimsAsIs;
    }

    /**
     * @param ?bool $value
     */
    public function setMapUnknownClaimsAsIs(?bool $value = null): self
    {
        $this->mapUnknownClaimsAsIs = $value;
        $this->_setField('mapUnknownClaimsAsIs');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPassthroughClaimsWithNoMapping(): ?bool
    {
        return $this->passthroughClaimsWithNoMapping;
    }

    /**
     * @param ?bool $value
     */
    public function setPassthroughClaimsWithNoMapping(?bool $value = null): self
    {
        $this->passthroughClaimsWithNoMapping = $value;
        $this->_setField('passthroughClaimsWithNoMapping');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getMapIdentities(): ?bool
    {
        return $this->mapIdentities;
    }

    /**
     * @param ?bool $value
     */
    public function setMapIdentities(?bool $value = null): self
    {
        $this->mapIdentities = $value;
        $this->_setField('mapIdentities');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSignatureAlgorithm(): ?string
    {
        return $this->signatureAlgorithm;
    }

    /**
     * @param ?string $value
     */
    public function setSignatureAlgorithm(?string $value = null): self
    {
        $this->signatureAlgorithm = $value;
        $this->_setField('signatureAlgorithm');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDigestAlgorithm(): ?string
    {
        return $this->digestAlgorithm;
    }

    /**
     * @param ?string $value
     */
    public function setDigestAlgorithm(?string $value = null): self
    {
        $this->digestAlgorithm = $value;
        $this->_setField('digestAlgorithm');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIssuer(): ?string
    {
        return $this->issuer;
    }

    /**
     * @param ?string $value
     */
    public function setIssuer(?string $value = null): self
    {
        $this->issuer = $value;
        $this->_setField('issuer');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDestination(): ?string
    {
        return $this->destination;
    }

    /**
     * @param ?string $value
     */
    public function setDestination(?string $value = null): self
    {
        $this->destination = $value;
        $this->_setField('destination');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLifetimeInSeconds(): ?int
    {
        return $this->lifetimeInSeconds;
    }

    /**
     * @param ?int $value
     */
    public function setLifetimeInSeconds(?int $value = null): self
    {
        $this->lifetimeInSeconds = $value;
        $this->_setField('lifetimeInSeconds');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSignResponse(): ?bool
    {
        return $this->signResponse;
    }

    /**
     * @param ?bool $value
     */
    public function setSignResponse(?bool $value = null): self
    {
        $this->signResponse = $value;
        $this->_setField('signResponse');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getNameIdentifierFormat(): ?string
    {
        return $this->nameIdentifierFormat;
    }

    /**
     * @param ?string $value
     */
    public function setNameIdentifierFormat(?string $value = null): self
    {
        $this->nameIdentifierFormat = $value;
        $this->_setField('nameIdentifierFormat');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getNameIdentifierProbes(): ?array
    {
        return $this->nameIdentifierProbes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setNameIdentifierProbes(?array $value = null): self
    {
        $this->nameIdentifierProbes = $value;
        $this->_setField('nameIdentifierProbes');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAuthnContextClassRef(): ?string
    {
        return $this->authnContextClassRef;
    }

    /**
     * @param ?string $value
     */
    public function setAuthnContextClassRef(?string $value = null): self
    {
        $this->authnContextClassRef = $value;
        $this->_setField('authnContextClassRef');
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
