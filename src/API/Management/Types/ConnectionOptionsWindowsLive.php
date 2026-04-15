<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'windowslive' connection
 */
class ConnectionOptionsWindowsLive extends JsonSerializableType
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
     * @var ?int $strategyVersion
     */
    #[JsonProperty('strategy_version')]
    private ?int $strategyVersion;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @var ?bool $applications When enabled, requests access to user's applications.
     */
    #[JsonProperty('applications')]
    private ?bool $applications;

    /**
     * @var ?bool $applicationsCreate When enabled, requests permission to create applications.
     */
    #[JsonProperty('applications_create')]
    private ?bool $applicationsCreate;

    /**
     * @var ?bool $basic When enabled, requests read access to user's basic profile information and contacts list.
     */
    #[JsonProperty('basic')]
    private ?bool $basic;

    /**
     * @var ?bool $birthday When enabled, requests read access to user's birth day, month, and year.
     */
    #[JsonProperty('birthday')]
    private ?bool $birthday;

    /**
     * @var ?bool $calendars When enabled, requests read access to user's calendars and events.
     */
    #[JsonProperty('calendars')]
    private ?bool $calendars;

    /**
     * @var ?bool $calendarsUpdate When enabled, requests read and write access to user's calendars and events.
     */
    #[JsonProperty('calendars_update')]
    private ?bool $calendarsUpdate;

    /**
     * @var ?bool $contactsBirthday When enabled, requests read access to contacts' birth day and birth month.
     */
    #[JsonProperty('contacts_birthday')]
    private ?bool $contactsBirthday;

    /**
     * @var ?bool $contactsCalendars When enabled, requests read access to user's calendars and shared calendars/events from others.
     */
    #[JsonProperty('contacts_calendars')]
    private ?bool $contactsCalendars;

    /**
     * @var ?bool $contactsCreate When enabled, requests permission to create new contacts in user's address book.
     */
    #[JsonProperty('contacts_create')]
    private ?bool $contactsCreate;

    /**
     * @var ?bool $contactsPhotos When enabled, requests read access to user's and shared albums, photos, videos, and audio.
     */
    #[JsonProperty('contacts_photos')]
    private ?bool $contactsPhotos;

    /**
     * @var ?bool $contactsSkydrive When enabled, requests read access to OneDrive files shared by other users.
     */
    #[JsonProperty('contacts_skydrive')]
    private ?bool $contactsSkydrive;

    /**
     * @var ?bool $directoryAccessasuserAll When enabled, allows the app to have the same access to information in the directory as the signed-in user.
     */
    #[JsonProperty('directory_accessasuser_all')]
    private ?bool $directoryAccessasuserAll;

    /**
     * @var ?bool $directoryReadAll When enabled, allows the app to read data in your organization's directory, such as users, groups, and apps.
     */
    #[JsonProperty('directory_read_all')]
    private ?bool $directoryReadAll;

    /**
     * @var ?bool $directoryReadwriteAll When enabled, allows the app to read and write data in your organization's directory, such as users and groups.
     */
    #[JsonProperty('directory_readwrite_all')]
    private ?bool $directoryReadwriteAll;

    /**
     * @var ?bool $emails When enabled, requests read access to personal, preferred, and business email addresses.
     */
    #[JsonProperty('emails')]
    private ?bool $emails;

    /**
     * @var ?bool $eventsCreate When enabled, requests permission to create events on user's default calendar.
     */
    #[JsonProperty('events_create')]
    private ?bool $eventsCreate;

    /**
     * @var ?bool $graphCalendars When enabled, requests permission to read the user's calendars.
     */
    #[JsonProperty('graph_calendars')]
    private ?bool $graphCalendars;

    /**
     * @var ?bool $graphCalendarsUpdate When enabled, requests permission to read and write the user's calendars.
     */
    #[JsonProperty('graph_calendars_update')]
    private ?bool $graphCalendarsUpdate;

    /**
     * @var ?bool $graphContacts When enabled, requests permission to read the user's contacts.
     */
    #[JsonProperty('graph_contacts')]
    private ?bool $graphContacts;

    /**
     * @var ?bool $graphContactsUpdate When enabled, requests permission to read and write the user's contacts.
     */
    #[JsonProperty('graph_contacts_update')]
    private ?bool $graphContactsUpdate;

    /**
     * @var ?bool $graphDevice When enabled, requests permission to read the user's device information.
     */
    #[JsonProperty('graph_device')]
    private ?bool $graphDevice;

    /**
     * @var ?bool $graphDeviceCommand When enabled, requests permission to send commands to the user's devices.
     */
    #[JsonProperty('graph_device_command')]
    private ?bool $graphDeviceCommand;

    /**
     * @var ?bool $graphEmails When enabled, requests permission to read the user's emails.
     */
    #[JsonProperty('graph_emails')]
    private ?bool $graphEmails;

    /**
     * @var ?bool $graphEmailsUpdate When enabled, requests permission to read and write the user's emails.
     */
    #[JsonProperty('graph_emails_update')]
    private ?bool $graphEmailsUpdate;

    /**
     * @var ?bool $graphFiles When enabled, requests permission to read the user's files.
     */
    #[JsonProperty('graph_files')]
    private ?bool $graphFiles;

    /**
     * @var ?bool $graphFilesAll When enabled, requests permission to read all files the user has access to.
     */
    #[JsonProperty('graph_files_all')]
    private ?bool $graphFilesAll;

    /**
     * @var ?bool $graphFilesAllUpdate When enabled, requests permission to read and write all files the user has access to.
     */
    #[JsonProperty('graph_files_all_update')]
    private ?bool $graphFilesAllUpdate;

    /**
     * @var ?bool $graphFilesUpdate When enabled, requests permission to read and write the user's files.
     */
    #[JsonProperty('graph_files_update')]
    private ?bool $graphFilesUpdate;

    /**
     * @var ?bool $graphNotes When enabled, requests permission to read the user's OneNote notebooks.
     */
    #[JsonProperty('graph_notes')]
    private ?bool $graphNotes;

    /**
     * @var ?bool $graphNotesCreate When enabled, requests permission to create new OneNote notebooks.
     */
    #[JsonProperty('graph_notes_create')]
    private ?bool $graphNotesCreate;

    /**
     * @var ?bool $graphNotesUpdate When enabled, requests permission to read and write the user's OneNote notebooks.
     */
    #[JsonProperty('graph_notes_update')]
    private ?bool $graphNotesUpdate;

    /**
     * @var ?bool $graphTasks When enabled, requests permission to read the user's tasks.
     */
    #[JsonProperty('graph_tasks')]
    private ?bool $graphTasks;

    /**
     * @var ?bool $graphTasksUpdate When enabled, requests permission to read and write the user's tasks.
     */
    #[JsonProperty('graph_tasks_update')]
    private ?bool $graphTasksUpdate;

    /**
     * @var ?bool $graphUser When enabled, requests permission to read the user's profile.
     */
    #[JsonProperty('graph_user')]
    private ?bool $graphUser;

    /**
     * @var ?bool $graphUserActivity When enabled, requests permission to read the user's activity history.
     */
    #[JsonProperty('graph_user_activity')]
    private ?bool $graphUserActivity;

    /**
     * @var ?bool $graphUserUpdate When enabled, requests permission to read and write the user's profile.
     */
    #[JsonProperty('graph_user_update')]
    private ?bool $graphUserUpdate;

    /**
     * @var ?bool $groupReadAll When enabled, allows the app to read all group properties and memberships.
     */
    #[JsonProperty('group_read_all')]
    private ?bool $groupReadAll;

    /**
     * @var ?bool $groupReadwriteAll When enabled, allows the app to create groups, read all group properties and memberships, update group properties and memberships, and delete groups.
     */
    #[JsonProperty('group_readwrite_all')]
    private ?bool $groupReadwriteAll;

    /**
     * @var ?bool $mailReadwriteAll When enabled, allows the app to create, read, update, and delete all mail in all mailboxes.
     */
    #[JsonProperty('mail_readwrite_all')]
    private ?bool $mailReadwriteAll;

    /**
     * @var ?bool $mailSend When enabled, allows the app to send mail as users in the organization.
     */
    #[JsonProperty('mail_send')]
    private ?bool $mailSend;

    /**
     * @var ?bool $messenger When enabled, requests access to user's Windows Live Messenger data.
     */
    #[JsonProperty('messenger')]
    private ?bool $messenger;

    /**
     * @var ?bool $offlineAccess When enabled, requests a refresh token for offline access.
     */
    #[JsonProperty('offline_access')]
    private ?bool $offlineAccess;

    /**
     * @var ?bool $phoneNumbers When enabled, requests read access to personal, business, and mobile phone numbers.
     */
    #[JsonProperty('phone_numbers')]
    private ?bool $phoneNumbers;

    /**
     * @var ?bool $photos When enabled, requests read access to user's photos, videos, audio, and albums.
     */
    #[JsonProperty('photos')]
    private ?bool $photos;

    /**
     * @var ?bool $postalAddresses When enabled, requests read access to personal and business postal addresses.
     */
    #[JsonProperty('postal_addresses')]
    private ?bool $postalAddresses;

    /**
     * @var ?bool $rolemanagementReadAll When enabled, allows the app to read the role-based access control (RBAC) settings for your company's directory.
     */
    #[JsonProperty('rolemanagement_read_all')]
    private ?bool $rolemanagementReadAll;

    /**
     * @var ?bool $rolemanagementReadwriteDirectory When enabled, allows the app to read and write the role-based access control (RBAC) settings for your company's directory.
     */
    #[JsonProperty('rolemanagement_readwrite_directory')]
    private ?bool $rolemanagementReadwriteDirectory;

    /**
     * @var ?bool $share When enabled, requests permission to share content with other users.
     */
    #[JsonProperty('share')]
    private ?bool $share;

    /**
     * @var ?bool $signin When enabled, provides single sign-in behavior for users already signed into their Microsoft account.
     */
    #[JsonProperty('signin')]
    private ?bool $signin;

    /**
     * @var ?bool $sitesReadAll When enabled, allows the app to read documents and list items in all SharePoint site collections.
     */
    #[JsonProperty('sites_read_all')]
    private ?bool $sitesReadAll;

    /**
     * @var ?bool $sitesReadwriteAll When enabled, allows the app to create, read, update, and delete documents and list items in all SharePoint site collections.
     */
    #[JsonProperty('sites_readwrite_all')]
    private ?bool $sitesReadwriteAll;

    /**
     * @var ?bool $skydrive When enabled, requests read access to user's files stored on OneDrive.
     */
    #[JsonProperty('skydrive')]
    private ?bool $skydrive;

    /**
     * @var ?bool $skydriveUpdate When enabled, requests read and write access to user's OneDrive files.
     */
    #[JsonProperty('skydrive_update')]
    private ?bool $skydriveUpdate;

    /**
     * @var ?bool $teamReadbasicAll When enabled, allows the app to read the names and descriptions of all teams.
     */
    #[JsonProperty('team_readbasic_all')]
    private ?bool $teamReadbasicAll;

    /**
     * @var ?bool $teamReadwriteAll When enabled, allows the app to read and write all teams' information and change team membership.
     */
    #[JsonProperty('team_readwrite_all')]
    private ?bool $teamReadwriteAll;

    /**
     * @var ?bool $userReadAll When enabled, allows the app to read the full set of profile properties, reports, and managers of all users.
     */
    #[JsonProperty('user_read_all')]
    private ?bool $userReadAll;

    /**
     * @var ?bool $userReadbasicAll When enabled, allows the app to read a basic set of profile properties of all users in the directory.
     */
    #[JsonProperty('user_readbasic_all')]
    private ?bool $userReadbasicAll;

    /**
     * @var ?bool $workProfile When enabled, requests read access to employer and work position information.
     */
    #[JsonProperty('work_profile')]
    private ?bool $workProfile;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   freeformScopes?: ?array<string>,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   strategyVersion?: ?int,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   applications?: ?bool,
     *   applicationsCreate?: ?bool,
     *   basic?: ?bool,
     *   birthday?: ?bool,
     *   calendars?: ?bool,
     *   calendarsUpdate?: ?bool,
     *   contactsBirthday?: ?bool,
     *   contactsCalendars?: ?bool,
     *   contactsCreate?: ?bool,
     *   contactsPhotos?: ?bool,
     *   contactsSkydrive?: ?bool,
     *   directoryAccessasuserAll?: ?bool,
     *   directoryReadAll?: ?bool,
     *   directoryReadwriteAll?: ?bool,
     *   emails?: ?bool,
     *   eventsCreate?: ?bool,
     *   graphCalendars?: ?bool,
     *   graphCalendarsUpdate?: ?bool,
     *   graphContacts?: ?bool,
     *   graphContactsUpdate?: ?bool,
     *   graphDevice?: ?bool,
     *   graphDeviceCommand?: ?bool,
     *   graphEmails?: ?bool,
     *   graphEmailsUpdate?: ?bool,
     *   graphFiles?: ?bool,
     *   graphFilesAll?: ?bool,
     *   graphFilesAllUpdate?: ?bool,
     *   graphFilesUpdate?: ?bool,
     *   graphNotes?: ?bool,
     *   graphNotesCreate?: ?bool,
     *   graphNotesUpdate?: ?bool,
     *   graphTasks?: ?bool,
     *   graphTasksUpdate?: ?bool,
     *   graphUser?: ?bool,
     *   graphUserActivity?: ?bool,
     *   graphUserUpdate?: ?bool,
     *   groupReadAll?: ?bool,
     *   groupReadwriteAll?: ?bool,
     *   mailReadwriteAll?: ?bool,
     *   mailSend?: ?bool,
     *   messenger?: ?bool,
     *   offlineAccess?: ?bool,
     *   phoneNumbers?: ?bool,
     *   photos?: ?bool,
     *   postalAddresses?: ?bool,
     *   rolemanagementReadAll?: ?bool,
     *   rolemanagementReadwriteDirectory?: ?bool,
     *   share?: ?bool,
     *   signin?: ?bool,
     *   sitesReadAll?: ?bool,
     *   sitesReadwriteAll?: ?bool,
     *   skydrive?: ?bool,
     *   skydriveUpdate?: ?bool,
     *   teamReadbasicAll?: ?bool,
     *   teamReadwriteAll?: ?bool,
     *   userReadAll?: ?bool,
     *   userReadbasicAll?: ?bool,
     *   workProfile?: ?bool,
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
        $this->strategyVersion = $values['strategyVersion'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->applications = $values['applications'] ?? null;
        $this->applicationsCreate = $values['applicationsCreate'] ?? null;
        $this->basic = $values['basic'] ?? null;
        $this->birthday = $values['birthday'] ?? null;
        $this->calendars = $values['calendars'] ?? null;
        $this->calendarsUpdate = $values['calendarsUpdate'] ?? null;
        $this->contactsBirthday = $values['contactsBirthday'] ?? null;
        $this->contactsCalendars = $values['contactsCalendars'] ?? null;
        $this->contactsCreate = $values['contactsCreate'] ?? null;
        $this->contactsPhotos = $values['contactsPhotos'] ?? null;
        $this->contactsSkydrive = $values['contactsSkydrive'] ?? null;
        $this->directoryAccessasuserAll = $values['directoryAccessasuserAll'] ?? null;
        $this->directoryReadAll = $values['directoryReadAll'] ?? null;
        $this->directoryReadwriteAll = $values['directoryReadwriteAll'] ?? null;
        $this->emails = $values['emails'] ?? null;
        $this->eventsCreate = $values['eventsCreate'] ?? null;
        $this->graphCalendars = $values['graphCalendars'] ?? null;
        $this->graphCalendarsUpdate = $values['graphCalendarsUpdate'] ?? null;
        $this->graphContacts = $values['graphContacts'] ?? null;
        $this->graphContactsUpdate = $values['graphContactsUpdate'] ?? null;
        $this->graphDevice = $values['graphDevice'] ?? null;
        $this->graphDeviceCommand = $values['graphDeviceCommand'] ?? null;
        $this->graphEmails = $values['graphEmails'] ?? null;
        $this->graphEmailsUpdate = $values['graphEmailsUpdate'] ?? null;
        $this->graphFiles = $values['graphFiles'] ?? null;
        $this->graphFilesAll = $values['graphFilesAll'] ?? null;
        $this->graphFilesAllUpdate = $values['graphFilesAllUpdate'] ?? null;
        $this->graphFilesUpdate = $values['graphFilesUpdate'] ?? null;
        $this->graphNotes = $values['graphNotes'] ?? null;
        $this->graphNotesCreate = $values['graphNotesCreate'] ?? null;
        $this->graphNotesUpdate = $values['graphNotesUpdate'] ?? null;
        $this->graphTasks = $values['graphTasks'] ?? null;
        $this->graphTasksUpdate = $values['graphTasksUpdate'] ?? null;
        $this->graphUser = $values['graphUser'] ?? null;
        $this->graphUserActivity = $values['graphUserActivity'] ?? null;
        $this->graphUserUpdate = $values['graphUserUpdate'] ?? null;
        $this->groupReadAll = $values['groupReadAll'] ?? null;
        $this->groupReadwriteAll = $values['groupReadwriteAll'] ?? null;
        $this->mailReadwriteAll = $values['mailReadwriteAll'] ?? null;
        $this->mailSend = $values['mailSend'] ?? null;
        $this->messenger = $values['messenger'] ?? null;
        $this->offlineAccess = $values['offlineAccess'] ?? null;
        $this->phoneNumbers = $values['phoneNumbers'] ?? null;
        $this->photos = $values['photos'] ?? null;
        $this->postalAddresses = $values['postalAddresses'] ?? null;
        $this->rolemanagementReadAll = $values['rolemanagementReadAll'] ?? null;
        $this->rolemanagementReadwriteDirectory = $values['rolemanagementReadwriteDirectory'] ?? null;
        $this->share = $values['share'] ?? null;
        $this->signin = $values['signin'] ?? null;
        $this->sitesReadAll = $values['sitesReadAll'] ?? null;
        $this->sitesReadwriteAll = $values['sitesReadwriteAll'] ?? null;
        $this->skydrive = $values['skydrive'] ?? null;
        $this->skydriveUpdate = $values['skydriveUpdate'] ?? null;
        $this->teamReadbasicAll = $values['teamReadbasicAll'] ?? null;
        $this->teamReadwriteAll = $values['teamReadwriteAll'] ?? null;
        $this->userReadAll = $values['userReadAll'] ?? null;
        $this->userReadbasicAll = $values['userReadbasicAll'] ?? null;
        $this->workProfile = $values['workProfile'] ?? null;
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
     * @return ?int
     */
    public function getStrategyVersion(): ?int
    {
        return $this->strategyVersion;
    }

    /**
     * @param ?int $value
     */
    public function setStrategyVersion(?int $value = null): self
    {
        $this->strategyVersion = $value;
        $this->_setField('strategyVersion');
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
    public function getApplications(): ?bool
    {
        return $this->applications;
    }

    /**
     * @param ?bool $value
     */
    public function setApplications(?bool $value = null): self
    {
        $this->applications = $value;
        $this->_setField('applications');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getApplicationsCreate(): ?bool
    {
        return $this->applicationsCreate;
    }

    /**
     * @param ?bool $value
     */
    public function setApplicationsCreate(?bool $value = null): self
    {
        $this->applicationsCreate = $value;
        $this->_setField('applicationsCreate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBasic(): ?bool
    {
        return $this->basic;
    }

    /**
     * @param ?bool $value
     */
    public function setBasic(?bool $value = null): self
    {
        $this->basic = $value;
        $this->_setField('basic');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBirthday(): ?bool
    {
        return $this->birthday;
    }

    /**
     * @param ?bool $value
     */
    public function setBirthday(?bool $value = null): self
    {
        $this->birthday = $value;
        $this->_setField('birthday');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCalendars(): ?bool
    {
        return $this->calendars;
    }

    /**
     * @param ?bool $value
     */
    public function setCalendars(?bool $value = null): self
    {
        $this->calendars = $value;
        $this->_setField('calendars');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCalendarsUpdate(): ?bool
    {
        return $this->calendarsUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setCalendarsUpdate(?bool $value = null): self
    {
        $this->calendarsUpdate = $value;
        $this->_setField('calendarsUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContactsBirthday(): ?bool
    {
        return $this->contactsBirthday;
    }

    /**
     * @param ?bool $value
     */
    public function setContactsBirthday(?bool $value = null): self
    {
        $this->contactsBirthday = $value;
        $this->_setField('contactsBirthday');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContactsCalendars(): ?bool
    {
        return $this->contactsCalendars;
    }

    /**
     * @param ?bool $value
     */
    public function setContactsCalendars(?bool $value = null): self
    {
        $this->contactsCalendars = $value;
        $this->_setField('contactsCalendars');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContactsCreate(): ?bool
    {
        return $this->contactsCreate;
    }

    /**
     * @param ?bool $value
     */
    public function setContactsCreate(?bool $value = null): self
    {
        $this->contactsCreate = $value;
        $this->_setField('contactsCreate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContactsPhotos(): ?bool
    {
        return $this->contactsPhotos;
    }

    /**
     * @param ?bool $value
     */
    public function setContactsPhotos(?bool $value = null): self
    {
        $this->contactsPhotos = $value;
        $this->_setField('contactsPhotos');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContactsSkydrive(): ?bool
    {
        return $this->contactsSkydrive;
    }

    /**
     * @param ?bool $value
     */
    public function setContactsSkydrive(?bool $value = null): self
    {
        $this->contactsSkydrive = $value;
        $this->_setField('contactsSkydrive');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDirectoryAccessasuserAll(): ?bool
    {
        return $this->directoryAccessasuserAll;
    }

    /**
     * @param ?bool $value
     */
    public function setDirectoryAccessasuserAll(?bool $value = null): self
    {
        $this->directoryAccessasuserAll = $value;
        $this->_setField('directoryAccessasuserAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDirectoryReadAll(): ?bool
    {
        return $this->directoryReadAll;
    }

    /**
     * @param ?bool $value
     */
    public function setDirectoryReadAll(?bool $value = null): self
    {
        $this->directoryReadAll = $value;
        $this->_setField('directoryReadAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDirectoryReadwriteAll(): ?bool
    {
        return $this->directoryReadwriteAll;
    }

    /**
     * @param ?bool $value
     */
    public function setDirectoryReadwriteAll(?bool $value = null): self
    {
        $this->directoryReadwriteAll = $value;
        $this->_setField('directoryReadwriteAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEmails(): ?bool
    {
        return $this->emails;
    }

    /**
     * @param ?bool $value
     */
    public function setEmails(?bool $value = null): self
    {
        $this->emails = $value;
        $this->_setField('emails');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEventsCreate(): ?bool
    {
        return $this->eventsCreate;
    }

    /**
     * @param ?bool $value
     */
    public function setEventsCreate(?bool $value = null): self
    {
        $this->eventsCreate = $value;
        $this->_setField('eventsCreate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphCalendars(): ?bool
    {
        return $this->graphCalendars;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphCalendars(?bool $value = null): self
    {
        $this->graphCalendars = $value;
        $this->_setField('graphCalendars');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphCalendarsUpdate(): ?bool
    {
        return $this->graphCalendarsUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphCalendarsUpdate(?bool $value = null): self
    {
        $this->graphCalendarsUpdate = $value;
        $this->_setField('graphCalendarsUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphContacts(): ?bool
    {
        return $this->graphContacts;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphContacts(?bool $value = null): self
    {
        $this->graphContacts = $value;
        $this->_setField('graphContacts');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphContactsUpdate(): ?bool
    {
        return $this->graphContactsUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphContactsUpdate(?bool $value = null): self
    {
        $this->graphContactsUpdate = $value;
        $this->_setField('graphContactsUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphDevice(): ?bool
    {
        return $this->graphDevice;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphDevice(?bool $value = null): self
    {
        $this->graphDevice = $value;
        $this->_setField('graphDevice');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphDeviceCommand(): ?bool
    {
        return $this->graphDeviceCommand;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphDeviceCommand(?bool $value = null): self
    {
        $this->graphDeviceCommand = $value;
        $this->_setField('graphDeviceCommand');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphEmails(): ?bool
    {
        return $this->graphEmails;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphEmails(?bool $value = null): self
    {
        $this->graphEmails = $value;
        $this->_setField('graphEmails');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphEmailsUpdate(): ?bool
    {
        return $this->graphEmailsUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphEmailsUpdate(?bool $value = null): self
    {
        $this->graphEmailsUpdate = $value;
        $this->_setField('graphEmailsUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphFiles(): ?bool
    {
        return $this->graphFiles;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphFiles(?bool $value = null): self
    {
        $this->graphFiles = $value;
        $this->_setField('graphFiles');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphFilesAll(): ?bool
    {
        return $this->graphFilesAll;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphFilesAll(?bool $value = null): self
    {
        $this->graphFilesAll = $value;
        $this->_setField('graphFilesAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphFilesAllUpdate(): ?bool
    {
        return $this->graphFilesAllUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphFilesAllUpdate(?bool $value = null): self
    {
        $this->graphFilesAllUpdate = $value;
        $this->_setField('graphFilesAllUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphFilesUpdate(): ?bool
    {
        return $this->graphFilesUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphFilesUpdate(?bool $value = null): self
    {
        $this->graphFilesUpdate = $value;
        $this->_setField('graphFilesUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphNotes(): ?bool
    {
        return $this->graphNotes;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphNotes(?bool $value = null): self
    {
        $this->graphNotes = $value;
        $this->_setField('graphNotes');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphNotesCreate(): ?bool
    {
        return $this->graphNotesCreate;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphNotesCreate(?bool $value = null): self
    {
        $this->graphNotesCreate = $value;
        $this->_setField('graphNotesCreate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphNotesUpdate(): ?bool
    {
        return $this->graphNotesUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphNotesUpdate(?bool $value = null): self
    {
        $this->graphNotesUpdate = $value;
        $this->_setField('graphNotesUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphTasks(): ?bool
    {
        return $this->graphTasks;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphTasks(?bool $value = null): self
    {
        $this->graphTasks = $value;
        $this->_setField('graphTasks');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphTasksUpdate(): ?bool
    {
        return $this->graphTasksUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphTasksUpdate(?bool $value = null): self
    {
        $this->graphTasksUpdate = $value;
        $this->_setField('graphTasksUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphUser(): ?bool
    {
        return $this->graphUser;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphUser(?bool $value = null): self
    {
        $this->graphUser = $value;
        $this->_setField('graphUser');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphUserActivity(): ?bool
    {
        return $this->graphUserActivity;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphUserActivity(?bool $value = null): self
    {
        $this->graphUserActivity = $value;
        $this->_setField('graphUserActivity');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGraphUserUpdate(): ?bool
    {
        return $this->graphUserUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setGraphUserUpdate(?bool $value = null): self
    {
        $this->graphUserUpdate = $value;
        $this->_setField('graphUserUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGroupReadAll(): ?bool
    {
        return $this->groupReadAll;
    }

    /**
     * @param ?bool $value
     */
    public function setGroupReadAll(?bool $value = null): self
    {
        $this->groupReadAll = $value;
        $this->_setField('groupReadAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGroupReadwriteAll(): ?bool
    {
        return $this->groupReadwriteAll;
    }

    /**
     * @param ?bool $value
     */
    public function setGroupReadwriteAll(?bool $value = null): self
    {
        $this->groupReadwriteAll = $value;
        $this->_setField('groupReadwriteAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getMailReadwriteAll(): ?bool
    {
        return $this->mailReadwriteAll;
    }

    /**
     * @param ?bool $value
     */
    public function setMailReadwriteAll(?bool $value = null): self
    {
        $this->mailReadwriteAll = $value;
        $this->_setField('mailReadwriteAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getMailSend(): ?bool
    {
        return $this->mailSend;
    }

    /**
     * @param ?bool $value
     */
    public function setMailSend(?bool $value = null): self
    {
        $this->mailSend = $value;
        $this->_setField('mailSend');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getMessenger(): ?bool
    {
        return $this->messenger;
    }

    /**
     * @param ?bool $value
     */
    public function setMessenger(?bool $value = null): self
    {
        $this->messenger = $value;
        $this->_setField('messenger');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getOfflineAccess(): ?bool
    {
        return $this->offlineAccess;
    }

    /**
     * @param ?bool $value
     */
    public function setOfflineAccess(?bool $value = null): self
    {
        $this->offlineAccess = $value;
        $this->_setField('offlineAccess');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPhoneNumbers(): ?bool
    {
        return $this->phoneNumbers;
    }

    /**
     * @param ?bool $value
     */
    public function setPhoneNumbers(?bool $value = null): self
    {
        $this->phoneNumbers = $value;
        $this->_setField('phoneNumbers');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPhotos(): ?bool
    {
        return $this->photos;
    }

    /**
     * @param ?bool $value
     */
    public function setPhotos(?bool $value = null): self
    {
        $this->photos = $value;
        $this->_setField('photos');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPostalAddresses(): ?bool
    {
        return $this->postalAddresses;
    }

    /**
     * @param ?bool $value
     */
    public function setPostalAddresses(?bool $value = null): self
    {
        $this->postalAddresses = $value;
        $this->_setField('postalAddresses');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRolemanagementReadAll(): ?bool
    {
        return $this->rolemanagementReadAll;
    }

    /**
     * @param ?bool $value
     */
    public function setRolemanagementReadAll(?bool $value = null): self
    {
        $this->rolemanagementReadAll = $value;
        $this->_setField('rolemanagementReadAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRolemanagementReadwriteDirectory(): ?bool
    {
        return $this->rolemanagementReadwriteDirectory;
    }

    /**
     * @param ?bool $value
     */
    public function setRolemanagementReadwriteDirectory(?bool $value = null): self
    {
        $this->rolemanagementReadwriteDirectory = $value;
        $this->_setField('rolemanagementReadwriteDirectory');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getShare(): ?bool
    {
        return $this->share;
    }

    /**
     * @param ?bool $value
     */
    public function setShare(?bool $value = null): self
    {
        $this->share = $value;
        $this->_setField('share');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSignin(): ?bool
    {
        return $this->signin;
    }

    /**
     * @param ?bool $value
     */
    public function setSignin(?bool $value = null): self
    {
        $this->signin = $value;
        $this->_setField('signin');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSitesReadAll(): ?bool
    {
        return $this->sitesReadAll;
    }

    /**
     * @param ?bool $value
     */
    public function setSitesReadAll(?bool $value = null): self
    {
        $this->sitesReadAll = $value;
        $this->_setField('sitesReadAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSitesReadwriteAll(): ?bool
    {
        return $this->sitesReadwriteAll;
    }

    /**
     * @param ?bool $value
     */
    public function setSitesReadwriteAll(?bool $value = null): self
    {
        $this->sitesReadwriteAll = $value;
        $this->_setField('sitesReadwriteAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSkydrive(): ?bool
    {
        return $this->skydrive;
    }

    /**
     * @param ?bool $value
     */
    public function setSkydrive(?bool $value = null): self
    {
        $this->skydrive = $value;
        $this->_setField('skydrive');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSkydriveUpdate(): ?bool
    {
        return $this->skydriveUpdate;
    }

    /**
     * @param ?bool $value
     */
    public function setSkydriveUpdate(?bool $value = null): self
    {
        $this->skydriveUpdate = $value;
        $this->_setField('skydriveUpdate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getTeamReadbasicAll(): ?bool
    {
        return $this->teamReadbasicAll;
    }

    /**
     * @param ?bool $value
     */
    public function setTeamReadbasicAll(?bool $value = null): self
    {
        $this->teamReadbasicAll = $value;
        $this->_setField('teamReadbasicAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getTeamReadwriteAll(): ?bool
    {
        return $this->teamReadwriteAll;
    }

    /**
     * @param ?bool $value
     */
    public function setTeamReadwriteAll(?bool $value = null): self
    {
        $this->teamReadwriteAll = $value;
        $this->_setField('teamReadwriteAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserReadAll(): ?bool
    {
        return $this->userReadAll;
    }

    /**
     * @param ?bool $value
     */
    public function setUserReadAll(?bool $value = null): self
    {
        $this->userReadAll = $value;
        $this->_setField('userReadAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserReadbasicAll(): ?bool
    {
        return $this->userReadbasicAll;
    }

    /**
     * @param ?bool $value
     */
    public function setUserReadbasicAll(?bool $value = null): self
    {
        $this->userReadbasicAll = $value;
        $this->_setField('userReadbasicAll');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getWorkProfile(): ?bool
    {
        return $this->workProfile;
    }

    /**
     * @param ?bool $value
     */
    public function setWorkProfile(?bool $value = null): self
    {
        $this->workProfile = $value;
        $this->_setField('workProfile');
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
