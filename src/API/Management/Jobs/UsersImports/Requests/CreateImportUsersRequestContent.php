<?php

namespace Auth0\SDK\API\Management\Jobs\UsersImports\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Utils\File;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateImportUsersRequestContent extends JsonSerializableType
{
    /**
     * @var File $users
     */
    private File $users;

    /**
     * @var string $connectionId connection_id of the connection to which users will be imported.
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var ?bool $upsert Whether to update users if they already exist (true) or to ignore them (false).
     */
    #[JsonProperty('upsert')]
    private ?bool $upsert;

    /**
     * @var ?string $externalId Customer-defined ID.
     */
    #[JsonProperty('external_id')]
    private ?string $externalId;

    /**
     * @var ?bool $sendCompletionEmail Whether to send a completion email to all tenant owners when the job is finished (true) or not (false).
     */
    #[JsonProperty('send_completion_email')]
    private ?bool $sendCompletionEmail;

    /**
     * @param array{
     *   users: File,
     *   connectionId: string,
     *   upsert?: ?bool,
     *   externalId?: ?string,
     *   sendCompletionEmail?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->users = $values['users'];
        $this->connectionId = $values['connectionId'];
        $this->upsert = $values['upsert'] ?? null;
        $this->externalId = $values['externalId'] ?? null;
        $this->sendCompletionEmail = $values['sendCompletionEmail'] ?? null;
    }

    /**
     * @return File
     */
    public function getUsers(): File
    {
        return $this->users;
    }

    /**
     * @param File $value
     */
    public function setUsers(File $value): self
    {
        $this->users = $value;
        $this->_setField('users');
        return $this;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUpsert(): ?bool
    {
        return $this->upsert;
    }

    /**
     * @param ?bool $value
     */
    public function setUpsert(?bool $value = null): self
    {
        $this->upsert = $value;
        $this->_setField('upsert');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @param ?string $value
     */
    public function setExternalId(?string $value = null): self
    {
        $this->externalId = $value;
        $this->_setField('externalId');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSendCompletionEmail(): ?bool
    {
        return $this->sendCompletionEmail;
    }

    /**
     * @param ?bool $value
     */
    public function setSendCompletionEmail(?bool $value = null): self
    {
        $this->sendCompletionEmail = $value;
        $this->_setField('sendCompletionEmail');
        return $this;
    }
}
