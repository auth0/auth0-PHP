<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommonSaml;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'samlp' connection
 */
class ConnectionOptionsSaml extends JsonSerializableType
{
    use ConnectionOptionsCommonSaml;
    use ConnectionOptionsCommon;

    /**
     * @var ?bool $debug
     */
    #[JsonProperty('debug')]
    private ?bool $debug;

    /**
     * @var ?bool $deflate
     */
    #[JsonProperty('deflate')]
    private ?bool $deflate;

    /**
     * @var ?string $destinationUrl
     */
    #[JsonProperty('destinationUrl')]
    private ?string $destinationUrl;

    /**
     * @var ?bool $disableSignout When true, disables sending SAML logout requests (SingleLogoutService) to the identity provider during user sign-out. The user will be logged out of Auth0 but will remain logged into the identity provider. Defaults to false (federated logout enabled).
     */
    #[JsonProperty('disableSignout')]
    private ?bool $disableSignout;

    /**
     * @var ?array<string, (
     *    string
     *   |array<string>
     * )> $fieldsMap
     */
    #[JsonProperty('fieldsMap'), ArrayType(['string' => new Union('string', ['string'])])]
    private ?array $fieldsMap;

    /**
     * @var ?string $globalTokenRevocationJwtIss
     */
    #[JsonProperty('global_token_revocation_jwt_iss')]
    private ?string $globalTokenRevocationJwtIss;

    /**
     * @var ?string $globalTokenRevocationJwtSub
     */
    #[JsonProperty('global_token_revocation_jwt_sub')]
    private ?string $globalTokenRevocationJwtSub;

    /**
     * @var ?string $metadataUrl
     */
    #[JsonProperty('metadataUrl')]
    private ?string $metadataUrl;

    /**
     * @var ?string $metadataXml
     */
    #[JsonProperty('metadataXml')]
    private ?string $metadataXml;

    /**
     * @var ?string $recipientUrl
     */
    #[JsonProperty('recipientUrl')]
    private ?string $recipientUrl;

    /**
     * @var ?string $requestTemplate
     */
    #[JsonProperty('requestTemplate')]
    private ?string $requestTemplate;

    /**
     * @var ?string $signingCert
     */
    #[JsonProperty('signingCert')]
    private ?string $signingCert;

    /**
     * @var ?ConnectionSigningKeySaml $signingKey
     */
    #[JsonProperty('signing_key')]
    private ?ConnectionSigningKeySaml $signingKey;

    /**
     * @var ?string $signOutEndpoint
     */
    #[JsonProperty('signOutEndpoint')]
    private ?string $signOutEndpoint;

    /**
     * @var ?string $userIdAttribute
     */
    #[JsonProperty('user_id_attribute')]
    private ?string $userIdAttribute;

    /**
     * @param array{
     *   assertionDecryptionSettings?: ?ConnectionAssertionDecryptionSettings,
     *   cert?: ?string,
     *   decryptionKey?: (
     *    ConnectionDecryptionKeySamlCert
     *   |string
     * )|null,
     *   digestAlgorithm?: ?value-of<ConnectionDigestAlgorithmEnumSaml>,
     *   domainAliases?: ?array<string>,
     *   entityId?: ?string,
     *   iconUrl?: ?string,
     *   idpinitiated?: ?ConnectionOptionsIdpinitiatedSaml,
     *   protocolBinding?: ?value-of<ConnectionProtocolBindingEnumSaml>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   signInEndpoint?: ?string,
     *   signSamlRequest?: ?bool,
     *   signatureAlgorithm?: ?value-of<ConnectionSignatureAlgorithmEnumSaml>,
     *   tenantDomain?: ?string,
     *   thumbprints?: ?array<string>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   nonPersistentAttrs?: ?array<string>,
     *   debug?: ?bool,
     *   deflate?: ?bool,
     *   destinationUrl?: ?string,
     *   disableSignout?: ?bool,
     *   fieldsMap?: ?array<string, (
     *    string
     *   |array<string>
     * )>,
     *   globalTokenRevocationJwtIss?: ?string,
     *   globalTokenRevocationJwtSub?: ?string,
     *   metadataUrl?: ?string,
     *   metadataXml?: ?string,
     *   recipientUrl?: ?string,
     *   requestTemplate?: ?string,
     *   signingCert?: ?string,
     *   signingKey?: ?ConnectionSigningKeySaml,
     *   signOutEndpoint?: ?string,
     *   userIdAttribute?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->assertionDecryptionSettings = $values['assertionDecryptionSettings'] ?? null;
        $this->cert = $values['cert'] ?? null;
        $this->decryptionKey = $values['decryptionKey'] ?? null;
        $this->digestAlgorithm = $values['digestAlgorithm'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->entityId = $values['entityId'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->idpinitiated = $values['idpinitiated'] ?? null;
        $this->protocolBinding = $values['protocolBinding'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->signInEndpoint = $values['signInEndpoint'] ?? null;
        $this->signSamlRequest = $values['signSamlRequest'] ?? null;
        $this->signatureAlgorithm = $values['signatureAlgorithm'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->thumbprints = $values['thumbprints'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->debug = $values['debug'] ?? null;
        $this->deflate = $values['deflate'] ?? null;
        $this->destinationUrl = $values['destinationUrl'] ?? null;
        $this->disableSignout = $values['disableSignout'] ?? null;
        $this->fieldsMap = $values['fieldsMap'] ?? null;
        $this->globalTokenRevocationJwtIss = $values['globalTokenRevocationJwtIss'] ?? null;
        $this->globalTokenRevocationJwtSub = $values['globalTokenRevocationJwtSub'] ?? null;
        $this->metadataUrl = $values['metadataUrl'] ?? null;
        $this->metadataXml = $values['metadataXml'] ?? null;
        $this->recipientUrl = $values['recipientUrl'] ?? null;
        $this->requestTemplate = $values['requestTemplate'] ?? null;
        $this->signingCert = $values['signingCert'] ?? null;
        $this->signingKey = $values['signingKey'] ?? null;
        $this->signOutEndpoint = $values['signOutEndpoint'] ?? null;
        $this->userIdAttribute = $values['userIdAttribute'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getDebug(): ?bool
    {
        return $this->debug;
    }

    /**
     * @param ?bool $value
     */
    public function setDebug(?bool $value = null): self
    {
        $this->debug = $value;
        $this->_setField('debug');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDeflate(): ?bool
    {
        return $this->deflate;
    }

    /**
     * @param ?bool $value
     */
    public function setDeflate(?bool $value = null): self
    {
        $this->deflate = $value;
        $this->_setField('deflate');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDestinationUrl(): ?string
    {
        return $this->destinationUrl;
    }

    /**
     * @param ?string $value
     */
    public function setDestinationUrl(?string $value = null): self
    {
        $this->destinationUrl = $value;
        $this->_setField('destinationUrl');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableSignout(): ?bool
    {
        return $this->disableSignout;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableSignout(?bool $value = null): self
    {
        $this->disableSignout = $value;
        $this->_setField('disableSignout');
        return $this;
    }

    /**
     * @return ?array<string, (
     *    string
     *   |array<string>
     * )>
     */
    public function getFieldsMap(): ?array
    {
        return $this->fieldsMap;
    }

    /**
     * @param ?array<string, (
     *    string
     *   |array<string>
     * )> $value
     */
    public function setFieldsMap(?array $value = null): self
    {
        $this->fieldsMap = $value;
        $this->_setField('fieldsMap');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getGlobalTokenRevocationJwtIss(): ?string
    {
        return $this->globalTokenRevocationJwtIss;
    }

    /**
     * @param ?string $value
     */
    public function setGlobalTokenRevocationJwtIss(?string $value = null): self
    {
        $this->globalTokenRevocationJwtIss = $value;
        $this->_setField('globalTokenRevocationJwtIss');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getGlobalTokenRevocationJwtSub(): ?string
    {
        return $this->globalTokenRevocationJwtSub;
    }

    /**
     * @param ?string $value
     */
    public function setGlobalTokenRevocationJwtSub(?string $value = null): self
    {
        $this->globalTokenRevocationJwtSub = $value;
        $this->_setField('globalTokenRevocationJwtSub');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMetadataUrl(): ?string
    {
        return $this->metadataUrl;
    }

    /**
     * @param ?string $value
     */
    public function setMetadataUrl(?string $value = null): self
    {
        $this->metadataUrl = $value;
        $this->_setField('metadataUrl');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMetadataXml(): ?string
    {
        return $this->metadataXml;
    }

    /**
     * @param ?string $value
     */
    public function setMetadataXml(?string $value = null): self
    {
        $this->metadataXml = $value;
        $this->_setField('metadataXml');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRecipientUrl(): ?string
    {
        return $this->recipientUrl;
    }

    /**
     * @param ?string $value
     */
    public function setRecipientUrl(?string $value = null): self
    {
        $this->recipientUrl = $value;
        $this->_setField('recipientUrl');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRequestTemplate(): ?string
    {
        return $this->requestTemplate;
    }

    /**
     * @param ?string $value
     */
    public function setRequestTemplate(?string $value = null): self
    {
        $this->requestTemplate = $value;
        $this->_setField('requestTemplate');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSigningCert(): ?string
    {
        return $this->signingCert;
    }

    /**
     * @param ?string $value
     */
    public function setSigningCert(?string $value = null): self
    {
        $this->signingCert = $value;
        $this->_setField('signingCert');
        return $this;
    }

    /**
     * @return ?ConnectionSigningKeySaml
     */
    public function getSigningKey(): ?ConnectionSigningKeySaml
    {
        return $this->signingKey;
    }

    /**
     * @param ?ConnectionSigningKeySaml $value
     */
    public function setSigningKey(?ConnectionSigningKeySaml $value = null): self
    {
        $this->signingKey = $value;
        $this->_setField('signingKey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSignOutEndpoint(): ?string
    {
        return $this->signOutEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setSignOutEndpoint(?string $value = null): self
    {
        $this->signOutEndpoint = $value;
        $this->_setField('signOutEndpoint');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserIdAttribute(): ?string
    {
        return $this->userIdAttribute;
    }

    /**
     * @param ?string $value
     */
    public function setUserIdAttribute(?string $value = null): self
    {
        $this->userIdAttribute = $value;
        $this->_setField('userIdAttribute');
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
