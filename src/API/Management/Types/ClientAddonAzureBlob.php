<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Azure Blob Storage addon configuration.
 */
class ClientAddonAzureBlob extends JsonSerializableType
{
    /**
     * @var ?string $accountName Your Azure storage account name. Usually first segment in your Azure storage URL. e.g. `https://acme-org.blob.core.windows.net` would be the account name `acme-org`.
     */
    #[JsonProperty('accountName')]
    private ?string $accountName;

    /**
     * @var ?string $storageAccessKey Access key associated with this storage account.
     */
    #[JsonProperty('storageAccessKey')]
    private ?string $storageAccessKey;

    /**
     * @var ?string $containerName Container to request a token for. e.g. `my-container`.
     */
    #[JsonProperty('containerName')]
    private ?string $containerName;

    /**
     * @var ?string $blobName Entity to request a token for. e.g. `my-blob`. If blank the computed SAS will apply to the entire storage container.
     */
    #[JsonProperty('blobName')]
    private ?string $blobName;

    /**
     * @var ?int $expiration Expiration in minutes for the generated token (default of 5 minutes).
     */
    #[JsonProperty('expiration')]
    private ?int $expiration;

    /**
     * @var ?string $signedIdentifier Shared access policy identifier defined in your storage account resource.
     */
    #[JsonProperty('signedIdentifier')]
    private ?string $signedIdentifier;

    /**
     * @var ?bool $blobRead Indicates if the issued token has permission to read the content, properties, metadata and block list. Use the blob as the source of a copy operation.
     */
    #[JsonProperty('blob_read')]
    private ?bool $blobRead;

    /**
     * @var ?bool $blobWrite Indicates if the issued token has permission to create or write content, properties, metadata, or block list. Snapshot or lease the blob. Resize the blob (page blob only). Use the blob as the destination of a copy operation within the same account.
     */
    #[JsonProperty('blob_write')]
    private ?bool $blobWrite;

    /**
     * @var ?bool $blobDelete Indicates if the issued token has permission to delete the blob.
     */
    #[JsonProperty('blob_delete')]
    private ?bool $blobDelete;

    /**
     * @var ?bool $containerRead Indicates if the issued token has permission to read the content, properties, metadata or block list of any blob in the container. Use any blob in the container as the source of a copy operation
     */
    #[JsonProperty('container_read')]
    private ?bool $containerRead;

    /**
     * @var ?bool $containerWrite Indicates that for any blob in the container if the issued token has permission to create or write content, properties, metadata, or block list. Snapshot or lease the blob. Resize the blob (page blob only). Use the blob as the destination of a copy operation within the same account.
     */
    #[JsonProperty('container_write')]
    private ?bool $containerWrite;

    /**
     * @var ?bool $containerDelete Indicates if issued token has permission to delete any blob in the container.
     */
    #[JsonProperty('container_delete')]
    private ?bool $containerDelete;

    /**
     * @var ?bool $containerList Indicates if the issued token has permission to list blobs in the container.
     */
    #[JsonProperty('container_list')]
    private ?bool $containerList;

    /**
     * @param array{
     *   accountName?: ?string,
     *   storageAccessKey?: ?string,
     *   containerName?: ?string,
     *   blobName?: ?string,
     *   expiration?: ?int,
     *   signedIdentifier?: ?string,
     *   blobRead?: ?bool,
     *   blobWrite?: ?bool,
     *   blobDelete?: ?bool,
     *   containerRead?: ?bool,
     *   containerWrite?: ?bool,
     *   containerDelete?: ?bool,
     *   containerList?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accountName = $values['accountName'] ?? null;
        $this->storageAccessKey = $values['storageAccessKey'] ?? null;
        $this->containerName = $values['containerName'] ?? null;
        $this->blobName = $values['blobName'] ?? null;
        $this->expiration = $values['expiration'] ?? null;
        $this->signedIdentifier = $values['signedIdentifier'] ?? null;
        $this->blobRead = $values['blobRead'] ?? null;
        $this->blobWrite = $values['blobWrite'] ?? null;
        $this->blobDelete = $values['blobDelete'] ?? null;
        $this->containerRead = $values['containerRead'] ?? null;
        $this->containerWrite = $values['containerWrite'] ?? null;
        $this->containerDelete = $values['containerDelete'] ?? null;
        $this->containerList = $values['containerList'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    /**
     * @param ?string $value
     */
    public function setAccountName(?string $value = null): self
    {
        $this->accountName = $value;
        $this->_setField('accountName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getStorageAccessKey(): ?string
    {
        return $this->storageAccessKey;
    }

    /**
     * @param ?string $value
     */
    public function setStorageAccessKey(?string $value = null): self
    {
        $this->storageAccessKey = $value;
        $this->_setField('storageAccessKey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getContainerName(): ?string
    {
        return $this->containerName;
    }

    /**
     * @param ?string $value
     */
    public function setContainerName(?string $value = null): self
    {
        $this->containerName = $value;
        $this->_setField('containerName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getBlobName(): ?string
    {
        return $this->blobName;
    }

    /**
     * @param ?string $value
     */
    public function setBlobName(?string $value = null): self
    {
        $this->blobName = $value;
        $this->_setField('blobName');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getExpiration(): ?int
    {
        return $this->expiration;
    }

    /**
     * @param ?int $value
     */
    public function setExpiration(?int $value = null): self
    {
        $this->expiration = $value;
        $this->_setField('expiration');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSignedIdentifier(): ?string
    {
        return $this->signedIdentifier;
    }

    /**
     * @param ?string $value
     */
    public function setSignedIdentifier(?string $value = null): self
    {
        $this->signedIdentifier = $value;
        $this->_setField('signedIdentifier');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBlobRead(): ?bool
    {
        return $this->blobRead;
    }

    /**
     * @param ?bool $value
     */
    public function setBlobRead(?bool $value = null): self
    {
        $this->blobRead = $value;
        $this->_setField('blobRead');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBlobWrite(): ?bool
    {
        return $this->blobWrite;
    }

    /**
     * @param ?bool $value
     */
    public function setBlobWrite(?bool $value = null): self
    {
        $this->blobWrite = $value;
        $this->_setField('blobWrite');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBlobDelete(): ?bool
    {
        return $this->blobDelete;
    }

    /**
     * @param ?bool $value
     */
    public function setBlobDelete(?bool $value = null): self
    {
        $this->blobDelete = $value;
        $this->_setField('blobDelete');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContainerRead(): ?bool
    {
        return $this->containerRead;
    }

    /**
     * @param ?bool $value
     */
    public function setContainerRead(?bool $value = null): self
    {
        $this->containerRead = $value;
        $this->_setField('containerRead');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContainerWrite(): ?bool
    {
        return $this->containerWrite;
    }

    /**
     * @param ?bool $value
     */
    public function setContainerWrite(?bool $value = null): self
    {
        $this->containerWrite = $value;
        $this->_setField('containerWrite');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContainerDelete(): ?bool
    {
        return $this->containerDelete;
    }

    /**
     * @param ?bool $value
     */
    public function setContainerDelete(?bool $value = null): self
    {
        $this->containerDelete = $value;
        $this->_setField('containerDelete');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContainerList(): ?bool
    {
        return $this->containerList;
    }

    /**
     * @param ?bool $value
     */
    public function setContainerList(?bool $value = null): self
    {
        $this->containerList = $value;
        $this->_setField('containerList');
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
