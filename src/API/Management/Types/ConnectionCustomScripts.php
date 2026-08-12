<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * A map of scripts used to integrate with a custom database.
 */
class ConnectionCustomScripts extends JsonSerializableType
{
    /**
     * @var ?string $login
     */
    #[JsonProperty('login')]
    private ?string $login;

    /**
     * @var ?string $getUser
     */
    #[JsonProperty('get_user')]
    private ?string $getUser;

    /**
     * @var ?string $delete
     */
    #[JsonProperty('delete')]
    private ?string $delete;

    /**
     * @var ?string $changePassword
     */
    #[JsonProperty('change_password')]
    private ?string $changePassword;

    /**
     * @var ?string $verify
     */
    #[JsonProperty('verify')]
    private ?string $verify;

    /**
     * @var ?string $create
     */
    #[JsonProperty('create')]
    private ?string $create;

    /**
     * @var ?string $changeUsername
     */
    #[JsonProperty('change_username')]
    private ?string $changeUsername;

    /**
     * @var ?string $changeEmail
     */
    #[JsonProperty('change_email')]
    private ?string $changeEmail;

    /**
     * @var ?string $changePhoneNumber
     */
    #[JsonProperty('change_phone_number')]
    private ?string $changePhoneNumber;

    /**
     * @param array{
     *   login?: ?string,
     *   getUser?: ?string,
     *   delete?: ?string,
     *   changePassword?: ?string,
     *   verify?: ?string,
     *   create?: ?string,
     *   changeUsername?: ?string,
     *   changeEmail?: ?string,
     *   changePhoneNumber?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->login = $values['login'] ?? null;
        $this->getUser = $values['getUser'] ?? null;
        $this->delete = $values['delete'] ?? null;
        $this->changePassword = $values['changePassword'] ?? null;
        $this->verify = $values['verify'] ?? null;
        $this->create = $values['create'] ?? null;
        $this->changeUsername = $values['changeUsername'] ?? null;
        $this->changeEmail = $values['changeEmail'] ?? null;
        $this->changePhoneNumber = $values['changePhoneNumber'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param ?string $value
     */
    public function setLogin(?string $value = null): self
    {
        $this->login = $value;
        $this->_setField('login');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getGetUser(): ?string
    {
        return $this->getUser;
    }

    /**
     * @param ?string $value
     */
    public function setGetUser(?string $value = null): self
    {
        $this->getUser = $value;
        $this->_setField('getUser');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDelete(): ?string
    {
        return $this->delete;
    }

    /**
     * @param ?string $value
     */
    public function setDelete(?string $value = null): self
    {
        $this->delete = $value;
        $this->_setField('delete');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getChangePassword(): ?string
    {
        return $this->changePassword;
    }

    /**
     * @param ?string $value
     */
    public function setChangePassword(?string $value = null): self
    {
        $this->changePassword = $value;
        $this->_setField('changePassword');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getVerify(): ?string
    {
        return $this->verify;
    }

    /**
     * @param ?string $value
     */
    public function setVerify(?string $value = null): self
    {
        $this->verify = $value;
        $this->_setField('verify');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCreate(): ?string
    {
        return $this->create;
    }

    /**
     * @param ?string $value
     */
    public function setCreate(?string $value = null): self
    {
        $this->create = $value;
        $this->_setField('create');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getChangeUsername(): ?string
    {
        return $this->changeUsername;
    }

    /**
     * @param ?string $value
     */
    public function setChangeUsername(?string $value = null): self
    {
        $this->changeUsername = $value;
        $this->_setField('changeUsername');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getChangeEmail(): ?string
    {
        return $this->changeEmail;
    }

    /**
     * @param ?string $value
     */
    public function setChangeEmail(?string $value = null): self
    {
        $this->changeEmail = $value;
        $this->_setField('changeEmail');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getChangePhoneNumber(): ?string
    {
        return $this->changePhoneNumber;
    }

    /**
     * @param ?string $value
     */
    public function setChangePhoneNumber(?string $value = null): self
    {
        $this->changePhoneNumber = $value;
        $this->_setField('changePhoneNumber');
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
