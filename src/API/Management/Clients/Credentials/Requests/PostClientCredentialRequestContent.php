<?php

namespace Auth0\SDK\API\Management\Clients\Credentials\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\ClientCredentialTypeEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\PublicKeyCredentialAlgorithmEnum;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class PostClientCredentialRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<ClientCredentialTypeEnum> $credentialType
     */
    #[JsonProperty('credential_type')]
    private string $credentialType;

    /**
     * @var ?string $name Friendly name for a credential.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $subjectDn Subject Distinguished Name. Mutually exclusive with `pem` property. Applies to `cert_subject_dn` credential type.
     */
    #[JsonProperty('subject_dn')]
    private ?string $subjectDn;

    /**
     * @var ?string $pem PEM-formatted public key (SPKI and PKCS1) or X509 certificate. Must be JSON escaped.
     */
    #[JsonProperty('pem')]
    private ?string $pem;

    /**
     * @var ?value-of<PublicKeyCredentialAlgorithmEnum> $alg
     */
    #[JsonProperty('alg')]
    private ?string $alg;

    /**
     * @var ?bool $parseExpiryFromCert Parse expiry from x509 certificate. If true, attempts to parse the expiry date from the provided PEM. Applies to `public_key` credential type.
     */
    #[JsonProperty('parse_expiry_from_cert')]
    private ?bool $parseExpiryFromCert;

    /**
     * @var ?DateTime $expiresAt The ISO 8601 formatted date representing the expiration of the credential. If not specified (not recommended), the credential never expires. Applies to `public_key` credential type.
     */
    #[JsonProperty('expires_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $expiresAt;

    /**
     * @var ?string $kid Optional kid (Key ID), used to uniquely identify the credential. If not specified, a kid value will be auto-generated. The kid header parameter in JWTs sent by your client should match this value. Valid format is [0-9a-zA-Z-_]{10,64}
     */
    #[JsonProperty('kid')]
    private ?string $kid;

    /**
     * @param array{
     *   credentialType: value-of<ClientCredentialTypeEnum>,
     *   name?: ?string,
     *   subjectDn?: ?string,
     *   pem?: ?string,
     *   alg?: ?value-of<PublicKeyCredentialAlgorithmEnum>,
     *   parseExpiryFromCert?: ?bool,
     *   expiresAt?: ?DateTime,
     *   kid?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentialType = $values['credentialType'];
        $this->name = $values['name'] ?? null;
        $this->subjectDn = $values['subjectDn'] ?? null;
        $this->pem = $values['pem'] ?? null;
        $this->alg = $values['alg'] ?? null;
        $this->parseExpiryFromCert = $values['parseExpiryFromCert'] ?? null;
        $this->expiresAt = $values['expiresAt'] ?? null;
        $this->kid = $values['kid'] ?? null;
    }

    /**
     * @return value-of<ClientCredentialTypeEnum>
     */
    public function getCredentialType(): string
    {
        return $this->credentialType;
    }

    /**
     * @param value-of<ClientCredentialTypeEnum> $value
     */
    public function setCredentialType(string $value): self
    {
        $this->credentialType = $value;
        $this->_setField('credentialType');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSubjectDn(): ?string
    {
        return $this->subjectDn;
    }

    /**
     * @param ?string $value
     */
    public function setSubjectDn(?string $value = null): self
    {
        $this->subjectDn = $value;
        $this->_setField('subjectDn');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPem(): ?string
    {
        return $this->pem;
    }

    /**
     * @param ?string $value
     */
    public function setPem(?string $value = null): self
    {
        $this->pem = $value;
        $this->_setField('pem');
        return $this;
    }

    /**
     * @return ?value-of<PublicKeyCredentialAlgorithmEnum>
     */
    public function getAlg(): ?string
    {
        return $this->alg;
    }

    /**
     * @param ?value-of<PublicKeyCredentialAlgorithmEnum> $value
     */
    public function setAlg(?string $value = null): self
    {
        $this->alg = $value;
        $this->_setField('alg');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getParseExpiryFromCert(): ?bool
    {
        return $this->parseExpiryFromCert;
    }

    /**
     * @param ?bool $value
     */
    public function setParseExpiryFromCert(?bool $value = null): self
    {
        $this->parseExpiryFromCert = $value;
        $this->_setField('parseExpiryFromCert');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getExpiresAt(): ?DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setExpiresAt(?DateTime $value = null): self
    {
        $this->expiresAt = $value;
        $this->_setField('expiresAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getKid(): ?string
    {
        return $this->kid;
    }

    /**
     * @param ?string $value
     */
    public function setKid(?string $value = null): self
    {
        $this->kid = $value;
        $this->_setField('kid');
        return $this;
    }
}
