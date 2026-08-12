<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'github' connection
 */
class ConnectionOptionsGitHub extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?string $clientId
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $clientSecret
     */
    #[JsonProperty('client_secret')]
    private ?string $clientSecret;

    /**
     * @var ?array<string> $freeformScopes
     */
    #[JsonProperty('freeform_scopes'), ArrayType(['string'])]
    private ?array $freeformScopes;

    /**
     * @var ?array<string> $scope
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private ?array $scope;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @var ?bool $adminOrg Requests the GitHub admin:org scope so Auth0 can fully manage organizations, teams, and memberships on behalf of the user.
     */
    #[JsonProperty('admin_org')]
    private ?bool $adminOrg;

    /**
     * @var ?bool $adminPublicKey Requests the admin:public_key scope to allow creating, updating, and deleting the user's SSH public keys.
     */
    #[JsonProperty('admin_public_key')]
    private ?bool $adminPublicKey;

    /**
     * @var ?bool $adminRepoHook Requests the admin:repo_hook scope so Auth0 can read, write, ping, and delete repository webhooks.
     */
    #[JsonProperty('admin_repo_hook')]
    private ?bool $adminRepoHook;

    /**
     * @var ?bool $deleteRepo Requests the delete_repo scope so the user can remove repositories they administer while signing in through Auth0.
     */
    #[JsonProperty('delete_repo')]
    private ?bool $deleteRepo;

    /**
     * @var ?bool $email Requests the user:email scope so Auth0 pulls addresses from GitHub's /user/emails endpoint and populates the profile.
     */
    #[JsonProperty('email')]
    private ?bool $email;

    /**
     * @var ?bool $follow Requests the user:follow scope to allow following or unfollowing GitHub users for the signed-in account.
     */
    #[JsonProperty('follow')]
    private ?bool $follow;

    /**
     * @var ?bool $gist Requests the gist scope so the application can create or update gists on behalf of the user.
     */
    #[JsonProperty('gist')]
    private ?bool $gist;

    /**
     * @var ?bool $notifications Requests the notifications scope to read GitHub inbox notifications; repo also implicitly grants this access.
     */
    #[JsonProperty('notifications')]
    private ?bool $notifications;

    /**
     * @var ?bool $profile Controls the GitHub read:user call that returns the user's basic profile (name, avatar, profile URL) and is on by default for successful logins.
     */
    #[JsonProperty('profile')]
    private ?bool $profile;

    /**
     * @var ?bool $publicRepo Requests the public_repo scope for read and write operations on public repositories, deployments, and statuses.
     */
    #[JsonProperty('public_repo')]
    private ?bool $publicRepo;

    /**
     * @var ?bool $readOrg Requests the read:org scope so Auth0 can view organizations, teams, and membership lists without making changes.
     */
    #[JsonProperty('read_org')]
    private ?bool $readOrg;

    /**
     * @var ?bool $readPublicKey Requests the read:public_key scope so Auth0 can list and inspect the user's SSH public keys.
     */
    #[JsonProperty('read_public_key')]
    private ?bool $readPublicKey;

    /**
     * @var ?bool $readRepoHook Requests the read:repo_hook scope to read and ping repository webhooks.
     */
    #[JsonProperty('read_repo_hook')]
    private ?bool $readRepoHook;

    /**
     * @var ?bool $readUser Requests the read:user scope to load extended profile information, implicitly covering user:email and user:follow.
     */
    #[JsonProperty('read_user')]
    private ?bool $readUser;

    /**
     * @var ?bool $repo Requests the repo scope for read and write access to both public and private repositories, deployments, and statuses.
     */
    #[JsonProperty('repo')]
    private ?bool $repo;

    /**
     * @var ?bool $repoDeployment Requests the repo_deployment scope in order to read and write deployment statuses for repositories.
     */
    #[JsonProperty('repo_deployment')]
    private ?bool $repoDeployment;

    /**
     * @var ?bool $repoStatus Requests the repo:status scope to manage commit statuses on public and private repositories.
     */
    #[JsonProperty('repo_status')]
    private ?bool $repoStatus;

    /**
     * @var ?bool $writeOrg Requests the write:org scope so Auth0 can change whether organization memberships are publicized.
     */
    #[JsonProperty('write_org')]
    private ?bool $writeOrg;

    /**
     * @var ?bool $writePublicKey Requests the write:public_key scope to create or update SSH public keys for the user.
     */
    #[JsonProperty('write_public_key')]
    private ?bool $writePublicKey;

    /**
     * @var ?bool $writeRepoHook Requests the write:repo_hook scope so Auth0 can read, create, update, and ping repository webhooks.
     */
    #[JsonProperty('write_repo_hook')]
    private ?bool $writeRepoHook;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   freeformScopes?: ?array<string>,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   adminOrg?: ?bool,
     *   adminPublicKey?: ?bool,
     *   adminRepoHook?: ?bool,
     *   deleteRepo?: ?bool,
     *   email?: ?bool,
     *   follow?: ?bool,
     *   gist?: ?bool,
     *   notifications?: ?bool,
     *   profile?: ?bool,
     *   publicRepo?: ?bool,
     *   readOrg?: ?bool,
     *   readPublicKey?: ?bool,
     *   readRepoHook?: ?bool,
     *   readUser?: ?bool,
     *   repo?: ?bool,
     *   repoDeployment?: ?bool,
     *   repoStatus?: ?bool,
     *   writeOrg?: ?bool,
     *   writePublicKey?: ?bool,
     *   writeRepoHook?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->freeformScopes = $values['freeformScopes'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->adminOrg = $values['adminOrg'] ?? null;
        $this->adminPublicKey = $values['adminPublicKey'] ?? null;
        $this->adminRepoHook = $values['adminRepoHook'] ?? null;
        $this->deleteRepo = $values['deleteRepo'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->follow = $values['follow'] ?? null;
        $this->gist = $values['gist'] ?? null;
        $this->notifications = $values['notifications'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->publicRepo = $values['publicRepo'] ?? null;
        $this->readOrg = $values['readOrg'] ?? null;
        $this->readPublicKey = $values['readPublicKey'] ?? null;
        $this->readRepoHook = $values['readRepoHook'] ?? null;
        $this->readUser = $values['readUser'] ?? null;
        $this->repo = $values['repo'] ?? null;
        $this->repoDeployment = $values['repoDeployment'] ?? null;
        $this->repoStatus = $values['repoStatus'] ?? null;
        $this->writeOrg = $values['writeOrg'] ?? null;
        $this->writePublicKey = $values['writePublicKey'] ?? null;
        $this->writeRepoHook = $values['writeRepoHook'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * @param ?string $value
     */
    public function setClientSecret(?string $value = null): self
    {
        $this->clientSecret = $value;
        $this->_setField('clientSecret');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getFreeformScopes(): ?array
    {
        return $this->freeformScopes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setFreeformScopes(?array $value = null): self
    {
        $this->freeformScopes = $value;
        $this->_setField('freeformScopes');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getScope(): ?array
    {
        return $this->scope;
    }

    /**
     * @param ?array<string> $value
     */
    public function setScope(?array $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<ConnectionSetUserRootAttributesEnum> $value
     */
    public function setSetUserRootAttributes(?string $value = null): self
    {
        $this->setUserRootAttributes = $value;
        $this->_setField('setUserRootAttributes');
        return $this;
    }

    /**
     * @return ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>
     */
    public function getUpstreamParams(): ?array
    {
        return $this->upstreamParams;
    }

    /**
     * @param ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $value
     */
    public function setUpstreamParams(?array $value = null): self
    {
        $this->upstreamParams = $value;
        $this->_setField('upstreamParams');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAdminOrg(): ?bool
    {
        return $this->adminOrg;
    }

    /**
     * @param ?bool $value
     */
    public function setAdminOrg(?bool $value = null): self
    {
        $this->adminOrg = $value;
        $this->_setField('adminOrg');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAdminPublicKey(): ?bool
    {
        return $this->adminPublicKey;
    }

    /**
     * @param ?bool $value
     */
    public function setAdminPublicKey(?bool $value = null): self
    {
        $this->adminPublicKey = $value;
        $this->_setField('adminPublicKey');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAdminRepoHook(): ?bool
    {
        return $this->adminRepoHook;
    }

    /**
     * @param ?bool $value
     */
    public function setAdminRepoHook(?bool $value = null): self
    {
        $this->adminRepoHook = $value;
        $this->_setField('adminRepoHook');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDeleteRepo(): ?bool
    {
        return $this->deleteRepo;
    }

    /**
     * @param ?bool $value
     */
    public function setDeleteRepo(?bool $value = null): self
    {
        $this->deleteRepo = $value;
        $this->_setField('deleteRepo');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEmail(): ?bool
    {
        return $this->email;
    }

    /**
     * @param ?bool $value
     */
    public function setEmail(?bool $value = null): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getFollow(): ?bool
    {
        return $this->follow;
    }

    /**
     * @param ?bool $value
     */
    public function setFollow(?bool $value = null): self
    {
        $this->follow = $value;
        $this->_setField('follow');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGist(): ?bool
    {
        return $this->gist;
    }

    /**
     * @param ?bool $value
     */
    public function setGist(?bool $value = null): self
    {
        $this->gist = $value;
        $this->_setField('gist');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getNotifications(): ?bool
    {
        return $this->notifications;
    }

    /**
     * @param ?bool $value
     */
    public function setNotifications(?bool $value = null): self
    {
        $this->notifications = $value;
        $this->_setField('notifications');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getProfile(): ?bool
    {
        return $this->profile;
    }

    /**
     * @param ?bool $value
     */
    public function setProfile(?bool $value = null): self
    {
        $this->profile = $value;
        $this->_setField('profile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPublicRepo(): ?bool
    {
        return $this->publicRepo;
    }

    /**
     * @param ?bool $value
     */
    public function setPublicRepo(?bool $value = null): self
    {
        $this->publicRepo = $value;
        $this->_setField('publicRepo');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReadOrg(): ?bool
    {
        return $this->readOrg;
    }

    /**
     * @param ?bool $value
     */
    public function setReadOrg(?bool $value = null): self
    {
        $this->readOrg = $value;
        $this->_setField('readOrg');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReadPublicKey(): ?bool
    {
        return $this->readPublicKey;
    }

    /**
     * @param ?bool $value
     */
    public function setReadPublicKey(?bool $value = null): self
    {
        $this->readPublicKey = $value;
        $this->_setField('readPublicKey');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReadRepoHook(): ?bool
    {
        return $this->readRepoHook;
    }

    /**
     * @param ?bool $value
     */
    public function setReadRepoHook(?bool $value = null): self
    {
        $this->readRepoHook = $value;
        $this->_setField('readRepoHook');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReadUser(): ?bool
    {
        return $this->readUser;
    }

    /**
     * @param ?bool $value
     */
    public function setReadUser(?bool $value = null): self
    {
        $this->readUser = $value;
        $this->_setField('readUser');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRepo(): ?bool
    {
        return $this->repo;
    }

    /**
     * @param ?bool $value
     */
    public function setRepo(?bool $value = null): self
    {
        $this->repo = $value;
        $this->_setField('repo');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRepoDeployment(): ?bool
    {
        return $this->repoDeployment;
    }

    /**
     * @param ?bool $value
     */
    public function setRepoDeployment(?bool $value = null): self
    {
        $this->repoDeployment = $value;
        $this->_setField('repoDeployment');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRepoStatus(): ?bool
    {
        return $this->repoStatus;
    }

    /**
     * @param ?bool $value
     */
    public function setRepoStatus(?bool $value = null): self
    {
        $this->repoStatus = $value;
        $this->_setField('repoStatus');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getWriteOrg(): ?bool
    {
        return $this->writeOrg;
    }

    /**
     * @param ?bool $value
     */
    public function setWriteOrg(?bool $value = null): self
    {
        $this->writeOrg = $value;
        $this->_setField('writeOrg');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getWritePublicKey(): ?bool
    {
        return $this->writePublicKey;
    }

    /**
     * @param ?bool $value
     */
    public function setWritePublicKey(?bool $value = null): self
    {
        $this->writePublicKey = $value;
        $this->_setField('writePublicKey');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getWriteRepoHook(): ?bool
    {
        return $this->writeRepoHook;
    }

    /**
     * @param ?bool $value
     */
    public function setWriteRepoHook(?bool $value = null): self
    {
        $this->writeRepoHook = $value;
        $this->_setField('writeRepoHook');
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
