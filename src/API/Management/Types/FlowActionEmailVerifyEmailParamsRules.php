<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionEmailVerifyEmailParamsRules extends JsonSerializableType
{
    /**
     * @var ?bool $requireMxRecord
     */
    #[JsonProperty('require_mx_record')]
    private ?bool $requireMxRecord;

    /**
     * @var ?bool $blockAliases
     */
    #[JsonProperty('block_aliases')]
    private ?bool $blockAliases;

    /**
     * @var ?bool $blockFreeEmails
     */
    #[JsonProperty('block_free_emails')]
    private ?bool $blockFreeEmails;

    /**
     * @var ?bool $blockDisposableEmails
     */
    #[JsonProperty('block_disposable_emails')]
    private ?bool $blockDisposableEmails;

    /**
     * @var ?array<string> $blocklist
     */
    #[JsonProperty('blocklist'), ArrayType(['string'])]
    private ?array $blocklist;

    /**
     * @var ?array<string> $allowlist
     */
    #[JsonProperty('allowlist'), ArrayType(['string'])]
    private ?array $allowlist;

    /**
     * @param array{
     *   requireMxRecord?: ?bool,
     *   blockAliases?: ?bool,
     *   blockFreeEmails?: ?bool,
     *   blockDisposableEmails?: ?bool,
     *   blocklist?: ?array<string>,
     *   allowlist?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->requireMxRecord = $values['requireMxRecord'] ?? null;
        $this->blockAliases = $values['blockAliases'] ?? null;
        $this->blockFreeEmails = $values['blockFreeEmails'] ?? null;
        $this->blockDisposableEmails = $values['blockDisposableEmails'] ?? null;
        $this->blocklist = $values['blocklist'] ?? null;
        $this->allowlist = $values['allowlist'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getRequireMxRecord(): ?bool
    {
        return $this->requireMxRecord;
    }

    /**
     * @param ?bool $value
     */
    public function setRequireMxRecord(?bool $value = null): self
    {
        $this->requireMxRecord = $value;
        $this->_setField('requireMxRecord');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBlockAliases(): ?bool
    {
        return $this->blockAliases;
    }

    /**
     * @param ?bool $value
     */
    public function setBlockAliases(?bool $value = null): self
    {
        $this->blockAliases = $value;
        $this->_setField('blockAliases');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBlockFreeEmails(): ?bool
    {
        return $this->blockFreeEmails;
    }

    /**
     * @param ?bool $value
     */
    public function setBlockFreeEmails(?bool $value = null): self
    {
        $this->blockFreeEmails = $value;
        $this->_setField('blockFreeEmails');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBlockDisposableEmails(): ?bool
    {
        return $this->blockDisposableEmails;
    }

    /**
     * @param ?bool $value
     */
    public function setBlockDisposableEmails(?bool $value = null): self
    {
        $this->blockDisposableEmails = $value;
        $this->_setField('blockDisposableEmails');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getBlocklist(): ?array
    {
        return $this->blocklist;
    }

    /**
     * @param ?array<string> $value
     */
    public function setBlocklist(?array $value = null): self
    {
        $this->blocklist = $value;
        $this->_setField('blocklist');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getAllowlist(): ?array
    {
        return $this->allowlist;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAllowlist(?array $value = null): self
    {
        $this->allowlist = $value;
        $this->_setField('allowlist');
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
