<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class NetworkAclAction extends JsonSerializableType
{
    /**
     * @var ?bool $block
     */
    #[JsonProperty('block')]
    private ?bool $block;

    /**
     * @var ?bool $allow
     */
    #[JsonProperty('allow')]
    private ?bool $allow;

    /**
     * @var ?bool $log
     */
    #[JsonProperty('log')]
    private ?bool $log;

    /**
     * @var ?bool $redirect
     */
    #[JsonProperty('redirect')]
    private ?bool $redirect;

    /**
     * @var ?string $redirectUri The URI to which the match or not_match requests will be routed
     */
    #[JsonProperty('redirect_uri')]
    private ?string $redirectUri;

    /**
     * @param array{
     *   block?: ?bool,
     *   allow?: ?bool,
     *   log?: ?bool,
     *   redirect?: ?bool,
     *   redirectUri?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->block = $values['block'] ?? null;
        $this->allow = $values['allow'] ?? null;
        $this->log = $values['log'] ?? null;
        $this->redirect = $values['redirect'] ?? null;
        $this->redirectUri = $values['redirectUri'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getBlock(): ?bool
    {
        return $this->block;
    }

    /**
     * @param ?bool $value
     */
    public function setBlock(?bool $value = null): self
    {
        $this->block = $value;
        $this->_setField('block');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllow(): ?bool
    {
        return $this->allow;
    }

    /**
     * @param ?bool $value
     */
    public function setAllow(?bool $value = null): self
    {
        $this->allow = $value;
        $this->_setField('allow');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getLog(): ?bool
    {
        return $this->log;
    }

    /**
     * @param ?bool $value
     */
    public function setLog(?bool $value = null): self
    {
        $this->log = $value;
        $this->_setField('log');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRedirect(): ?bool
    {
        return $this->redirect;
    }

    /**
     * @param ?bool $value
     */
    public function setRedirect(?bool $value = null): self
    {
        $this->redirect = $value;
        $this->_setField('redirect');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRedirectUri(): ?string
    {
        return $this->redirectUri;
    }

    /**
     * @param ?string $value
     */
    public function setRedirectUri(?string $value = null): self
    {
        $this->redirectUri = $value;
        $this->_setField('redirectUri');
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
