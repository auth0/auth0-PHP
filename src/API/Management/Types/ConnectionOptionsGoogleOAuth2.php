<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'google-oauth2' connection
 */
class ConnectionOptionsGoogleOAuth2 extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?array<string> $allowedAudiences
     */
    #[JsonProperty('allowed_audiences'), ArrayType(['string'])]
    private ?array $allowedAudiences;

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
     * @var ?string $iconUrl
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

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
     * @var ?bool $adsenseManagement View and manage user's ad applications, ad units, and channels in AdSense
     */
    #[JsonProperty('adsense_management')]
    private ?bool $adsenseManagement;

    /**
     * @var ?bool $analytics View user's configuration information and reports
     */
    #[JsonProperty('analytics')]
    private ?bool $analytics;

    /**
     * @var ?bool $blogger View and manage user's posts and blogs on Blogger and Blogger comments
     */
    #[JsonProperty('blogger')]
    private ?bool $blogger;

    /**
     * @var ?bool $calendar See, edit, share, and permanently delete all the calendars you can access using Google Calendar
     */
    #[JsonProperty('calendar')]
    private ?bool $calendar;

    /**
     * @var ?bool $calendarAddonsExecute Run as a Calendar add-on
     */
    #[JsonProperty('calendar_addons_execute')]
    private ?bool $calendarAddonsExecute;

    /**
     * @var ?bool $calendarEvents View and edit events on all your calendars
     */
    #[JsonProperty('calendar_events')]
    private ?bool $calendarEvents;

    /**
     * @var ?bool $calendarEventsReadonly View events on all your calendars
     */
    #[JsonProperty('calendar_events_readonly')]
    private ?bool $calendarEventsReadonly;

    /**
     * @var ?bool $calendarSettingsReadonly View your Calendar settings
     */
    #[JsonProperty('calendar_settings_readonly')]
    private ?bool $calendarSettingsReadonly;

    /**
     * @var ?bool $chromeWebStore Read access to user's chrome web store
     */
    #[JsonProperty('chrome_web_store')]
    private ?bool $chromeWebStore;

    /**
     * @var ?bool $contacts Full access to the authenticated user's contacts
     */
    #[JsonProperty('contacts')]
    private ?bool $contacts;

    /**
     * @var ?bool $contactsNew Full access to the authenticated user's contacts
     */
    #[JsonProperty('contacts_new')]
    private ?bool $contactsNew;

    /**
     * @var ?bool $contactsOtherReadonly Read-only access to the authenticated user's 'Other contacts'
     */
    #[JsonProperty('contacts_other_readonly')]
    private ?bool $contactsOtherReadonly;

    /**
     * @var ?bool $contactsReadonly Read-only access to the authenticated user's contacts
     */
    #[JsonProperty('contacts_readonly')]
    private ?bool $contactsReadonly;

    /**
     * @var ?bool $contentApiForShopping View and manage user's products, feeds, and subaccounts
     */
    #[JsonProperty('content_api_for_shopping')]
    private ?bool $contentApiForShopping;

    /**
     * @var ?bool $coordinate Grants read and write access to the Coordinate API
     */
    #[JsonProperty('coordinate')]
    private ?bool $coordinate;

    /**
     * @var ?bool $coordinateReadonly Grants read access to the Coordinate API
     */
    #[JsonProperty('coordinate_readonly')]
    private ?bool $coordinateReadonly;

    /**
     * @var ?bool $directoryReadonly Read-only access to the authenticated user's corporate directory (if applicable)
     */
    #[JsonProperty('directory_readonly')]
    private ?bool $directoryReadonly;

    /**
     * @var ?bool $documentList Access to Google Docs document list feed
     */
    #[JsonProperty('document_list')]
    private ?bool $documentList;

    /**
     * @var ?bool $drive Full access to all files and folders in the user's Google Drive
     */
    #[JsonProperty('drive')]
    private ?bool $drive;

    /**
     * @var ?bool $driveActivity View and add to the activity record of files in your Drive
     */
    #[JsonProperty('drive_activity')]
    private ?bool $driveActivity;

    /**
     * @var ?bool $driveActivityReadonly View the activity record of files in your Drive
     */
    #[JsonProperty('drive_activity_readonly')]
    private ?bool $driveActivityReadonly;

    /**
     * @var ?bool $driveAppdata Access to the application's configuration data in the user's Google Drive
     */
    #[JsonProperty('drive_appdata')]
    private ?bool $driveAppdata;

    /**
     * @var ?bool $driveAppsReadonly View apps authorized to access your Drive
     */
    #[JsonProperty('drive_apps_readonly')]
    private ?bool $driveAppsReadonly;

    /**
     * @var ?bool $driveFile Access to files created or opened by the app
     */
    #[JsonProperty('drive_file')]
    private ?bool $driveFile;

    /**
     * @var ?bool $driveMetadata Access to file metadata, including listing files and folders
     */
    #[JsonProperty('drive_metadata')]
    private ?bool $driveMetadata;

    /**
     * @var ?bool $driveMetadataReadonly Read-only access to file metadata
     */
    #[JsonProperty('drive_metadata_readonly')]
    private ?bool $driveMetadataReadonly;

    /**
     * @var ?bool $drivePhotosReadonly Read-only access to the user's Google Photos
     */
    #[JsonProperty('drive_photos_readonly')]
    private ?bool $drivePhotosReadonly;

    /**
     * @var ?bool $driveReadonly Read-only access to all files and folders in the user's Google Drive
     */
    #[JsonProperty('drive_readonly')]
    private ?bool $driveReadonly;

    /**
     * @var ?bool $driveScripts Modify the behavior of Google Apps Scripts
     */
    #[JsonProperty('drive_scripts')]
    private ?bool $driveScripts;

    /**
     * @var ?bool $email Email and verified email flag
     */
    #[JsonProperty('email')]
    private ?bool $email;

    /**
     * @var ?bool $gmail Full access to the account's mailboxes, including permanent deletion of threads and messages
     */
    #[JsonProperty('gmail')]
    private ?bool $gmail;

    /**
     * @var ?bool $gmailCompose Read all resources and their metadata—no write operations
     */
    #[JsonProperty('gmail_compose')]
    private ?bool $gmailCompose;

    /**
     * @var ?bool $gmailInsert Insert and import messages only
     */
    #[JsonProperty('gmail_insert')]
    private ?bool $gmailInsert;

    /**
     * @var ?bool $gmailLabels Create, read, update, and delete labels only
     */
    #[JsonProperty('gmail_labels')]
    private ?bool $gmailLabels;

    /**
     * @var ?bool $gmailMetadata Read resources metadata including labels, history records, and email message headers, but not the message body or attachments
     */
    #[JsonProperty('gmail_metadata')]
    private ?bool $gmailMetadata;

    /**
     * @var ?bool $gmailModify All read/write operations except immediate, permanent deletion of threads and messages, bypassing Trash
     */
    #[JsonProperty('gmail_modify')]
    private ?bool $gmailModify;

    /**
     * @var ?bool $gmailNew Full access to the account's mailboxes, including permanent deletion of threads and messages
     */
    #[JsonProperty('gmail_new')]
    private ?bool $gmailNew;

    /**
     * @var ?bool $gmailReadonly Read all resources and their metadata—no write operations
     */
    #[JsonProperty('gmail_readonly')]
    private ?bool $gmailReadonly;

    /**
     * @var ?bool $gmailSend Send messages only. No read or modify privileges on mailbox
     */
    #[JsonProperty('gmail_send')]
    private ?bool $gmailSend;

    /**
     * @var ?bool $gmailSettingsBasic Manage basic mail settings
     */
    #[JsonProperty('gmail_settings_basic')]
    private ?bool $gmailSettingsBasic;

    /**
     * @var ?bool $gmailSettingsSharing Manage sensitive mail settings, including forwarding rules and aliases. Note: Operations guarded by this scope are restricted to administrative use only
     */
    #[JsonProperty('gmail_settings_sharing')]
    private ?bool $gmailSettingsSharing;

    /**
     * @var ?bool $googleAffiliateNetwork View and manage user's publisher data in the Google Affiliate Network
     */
    #[JsonProperty('google_affiliate_network')]
    private ?bool $googleAffiliateNetwork;

    /**
     * @var ?bool $googleBooks View and manage user's books and library in Google Books
     */
    #[JsonProperty('google_books')]
    private ?bool $googleBooks;

    /**
     * @var ?bool $googleCloudStorage View and manage user's data stored in Google Cloud Storage
     */
    #[JsonProperty('google_cloud_storage')]
    private ?bool $googleCloudStorage;

    /**
     * @var ?bool $googleDrive Full access to all files and folders in the user's Google Drive
     */
    #[JsonProperty('google_drive')]
    private ?bool $googleDrive;

    /**
     * @var ?bool $googleDriveFiles Access to files created or opened by the app
     */
    #[JsonProperty('google_drive_files')]
    private ?bool $googleDriveFiles;

    /**
     * @var ?bool $googlePlus Associate user with its public Google profile
     */
    #[JsonProperty('google_plus')]
    private ?bool $googlePlus;

    /**
     * @var ?bool $latitudeBest View and manage user's best-available current location and location history in Google Latitude
     */
    #[JsonProperty('latitude_best')]
    private ?bool $latitudeBest;

    /**
     * @var ?bool $latitudeCity View and manage user's city-level current location and location history in Google Latitude
     */
    #[JsonProperty('latitude_city')]
    private ?bool $latitudeCity;

    /**
     * @var ?bool $moderator View and manage user's votes, topics, and submissions
     */
    #[JsonProperty('moderator')]
    private ?bool $moderator;

    /**
     * @var ?bool $offlineAccess Request a refresh token when the user authorizes your application
     */
    #[JsonProperty('offline_access')]
    private ?bool $offlineAccess;

    /**
     * @var ?bool $orkut View and manage user's friends, applications and profile and status
     */
    #[JsonProperty('orkut')]
    private ?bool $orkut;

    /**
     * @var ?bool $picasaWeb View and manage user's Google photos, videos, photo and video tags and comments
     */
    #[JsonProperty('picasa_web')]
    private ?bool $picasaWeb;

    /**
     * @var ?bool $profile Name, public profile URL, photo, country, language, and timezone
     */
    #[JsonProperty('profile')]
    private ?bool $profile;

    /**
     * @var ?bool $sites View and manage user's sites on Google Sites
     */
    #[JsonProperty('sites')]
    private ?bool $sites;

    /**
     * @var ?bool $tasks Full access to create, edit, organize, and delete all your tasks
     */
    #[JsonProperty('tasks')]
    private ?bool $tasks;

    /**
     * @var ?bool $tasksReadonly Read-only access to view your tasks and task lists
     */
    #[JsonProperty('tasks_readonly')]
    private ?bool $tasksReadonly;

    /**
     * @var ?bool $urlShortener View, manage and view statistics user's short URLs
     */
    #[JsonProperty('url_shortener')]
    private ?bool $urlShortener;

    /**
     * @var ?bool $webmasterTools View and manage user's sites and messages, view keywords
     */
    #[JsonProperty('webmaster_tools')]
    private ?bool $webmasterTools;

    /**
     * @var ?bool $youtube Manage your YouTube account
     */
    #[JsonProperty('youtube')]
    private ?bool $youtube;

    /**
     * @var ?bool $youtubeChannelmembershipsCreator See a list of your current active channel members, their current level, and when they became a member
     */
    #[JsonProperty('youtube_channelmemberships_creator')]
    private ?bool $youtubeChannelmembershipsCreator;

    /**
     * @var ?bool $youtubeNew Manage your YouTube account
     */
    #[JsonProperty('youtube_new')]
    private ?bool $youtubeNew;

    /**
     * @var ?bool $youtubeReadonly View your YouTube account
     */
    #[JsonProperty('youtube_readonly')]
    private ?bool $youtubeReadonly;

    /**
     * @var ?bool $youtubeUpload Manage your YouTube videos
     */
    #[JsonProperty('youtube_upload')]
    private ?bool $youtubeUpload;

    /**
     * @var ?bool $youtubepartner View and manage your assets and associated content on YouTube
     */
    #[JsonProperty('youtubepartner')]
    private ?bool $youtubepartner;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   allowedAudiences?: ?array<string>,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   freeformScopes?: ?array<string>,
     *   iconUrl?: ?string,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   adsenseManagement?: ?bool,
     *   analytics?: ?bool,
     *   blogger?: ?bool,
     *   calendar?: ?bool,
     *   calendarAddonsExecute?: ?bool,
     *   calendarEvents?: ?bool,
     *   calendarEventsReadonly?: ?bool,
     *   calendarSettingsReadonly?: ?bool,
     *   chromeWebStore?: ?bool,
     *   contacts?: ?bool,
     *   contactsNew?: ?bool,
     *   contactsOtherReadonly?: ?bool,
     *   contactsReadonly?: ?bool,
     *   contentApiForShopping?: ?bool,
     *   coordinate?: ?bool,
     *   coordinateReadonly?: ?bool,
     *   directoryReadonly?: ?bool,
     *   documentList?: ?bool,
     *   drive?: ?bool,
     *   driveActivity?: ?bool,
     *   driveActivityReadonly?: ?bool,
     *   driveAppdata?: ?bool,
     *   driveAppsReadonly?: ?bool,
     *   driveFile?: ?bool,
     *   driveMetadata?: ?bool,
     *   driveMetadataReadonly?: ?bool,
     *   drivePhotosReadonly?: ?bool,
     *   driveReadonly?: ?bool,
     *   driveScripts?: ?bool,
     *   email?: ?bool,
     *   gmail?: ?bool,
     *   gmailCompose?: ?bool,
     *   gmailInsert?: ?bool,
     *   gmailLabels?: ?bool,
     *   gmailMetadata?: ?bool,
     *   gmailModify?: ?bool,
     *   gmailNew?: ?bool,
     *   gmailReadonly?: ?bool,
     *   gmailSend?: ?bool,
     *   gmailSettingsBasic?: ?bool,
     *   gmailSettingsSharing?: ?bool,
     *   googleAffiliateNetwork?: ?bool,
     *   googleBooks?: ?bool,
     *   googleCloudStorage?: ?bool,
     *   googleDrive?: ?bool,
     *   googleDriveFiles?: ?bool,
     *   googlePlus?: ?bool,
     *   latitudeBest?: ?bool,
     *   latitudeCity?: ?bool,
     *   moderator?: ?bool,
     *   offlineAccess?: ?bool,
     *   orkut?: ?bool,
     *   picasaWeb?: ?bool,
     *   profile?: ?bool,
     *   sites?: ?bool,
     *   tasks?: ?bool,
     *   tasksReadonly?: ?bool,
     *   urlShortener?: ?bool,
     *   webmasterTools?: ?bool,
     *   youtube?: ?bool,
     *   youtubeChannelmembershipsCreator?: ?bool,
     *   youtubeNew?: ?bool,
     *   youtubeReadonly?: ?bool,
     *   youtubeUpload?: ?bool,
     *   youtubepartner?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->allowedAudiences = $values['allowedAudiences'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->freeformScopes = $values['freeformScopes'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->adsenseManagement = $values['adsenseManagement'] ?? null;
        $this->analytics = $values['analytics'] ?? null;
        $this->blogger = $values['blogger'] ?? null;
        $this->calendar = $values['calendar'] ?? null;
        $this->calendarAddonsExecute = $values['calendarAddonsExecute'] ?? null;
        $this->calendarEvents = $values['calendarEvents'] ?? null;
        $this->calendarEventsReadonly = $values['calendarEventsReadonly'] ?? null;
        $this->calendarSettingsReadonly = $values['calendarSettingsReadonly'] ?? null;
        $this->chromeWebStore = $values['chromeWebStore'] ?? null;
        $this->contacts = $values['contacts'] ?? null;
        $this->contactsNew = $values['contactsNew'] ?? null;
        $this->contactsOtherReadonly = $values['contactsOtherReadonly'] ?? null;
        $this->contactsReadonly = $values['contactsReadonly'] ?? null;
        $this->contentApiForShopping = $values['contentApiForShopping'] ?? null;
        $this->coordinate = $values['coordinate'] ?? null;
        $this->coordinateReadonly = $values['coordinateReadonly'] ?? null;
        $this->directoryReadonly = $values['directoryReadonly'] ?? null;
        $this->documentList = $values['documentList'] ?? null;
        $this->drive = $values['drive'] ?? null;
        $this->driveActivity = $values['driveActivity'] ?? null;
        $this->driveActivityReadonly = $values['driveActivityReadonly'] ?? null;
        $this->driveAppdata = $values['driveAppdata'] ?? null;
        $this->driveAppsReadonly = $values['driveAppsReadonly'] ?? null;
        $this->driveFile = $values['driveFile'] ?? null;
        $this->driveMetadata = $values['driveMetadata'] ?? null;
        $this->driveMetadataReadonly = $values['driveMetadataReadonly'] ?? null;
        $this->drivePhotosReadonly = $values['drivePhotosReadonly'] ?? null;
        $this->driveReadonly = $values['driveReadonly'] ?? null;
        $this->driveScripts = $values['driveScripts'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->gmail = $values['gmail'] ?? null;
        $this->gmailCompose = $values['gmailCompose'] ?? null;
        $this->gmailInsert = $values['gmailInsert'] ?? null;
        $this->gmailLabels = $values['gmailLabels'] ?? null;
        $this->gmailMetadata = $values['gmailMetadata'] ?? null;
        $this->gmailModify = $values['gmailModify'] ?? null;
        $this->gmailNew = $values['gmailNew'] ?? null;
        $this->gmailReadonly = $values['gmailReadonly'] ?? null;
        $this->gmailSend = $values['gmailSend'] ?? null;
        $this->gmailSettingsBasic = $values['gmailSettingsBasic'] ?? null;
        $this->gmailSettingsSharing = $values['gmailSettingsSharing'] ?? null;
        $this->googleAffiliateNetwork = $values['googleAffiliateNetwork'] ?? null;
        $this->googleBooks = $values['googleBooks'] ?? null;
        $this->googleCloudStorage = $values['googleCloudStorage'] ?? null;
        $this->googleDrive = $values['googleDrive'] ?? null;
        $this->googleDriveFiles = $values['googleDriveFiles'] ?? null;
        $this->googlePlus = $values['googlePlus'] ?? null;
        $this->latitudeBest = $values['latitudeBest'] ?? null;
        $this->latitudeCity = $values['latitudeCity'] ?? null;
        $this->moderator = $values['moderator'] ?? null;
        $this->offlineAccess = $values['offlineAccess'] ?? null;
        $this->orkut = $values['orkut'] ?? null;
        $this->picasaWeb = $values['picasaWeb'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->sites = $values['sites'] ?? null;
        $this->tasks = $values['tasks'] ?? null;
        $this->tasksReadonly = $values['tasksReadonly'] ?? null;
        $this->urlShortener = $values['urlShortener'] ?? null;
        $this->webmasterTools = $values['webmasterTools'] ?? null;
        $this->youtube = $values['youtube'] ?? null;
        $this->youtubeChannelmembershipsCreator = $values['youtubeChannelmembershipsCreator'] ?? null;
        $this->youtubeNew = $values['youtubeNew'] ?? null;
        $this->youtubeReadonly = $values['youtubeReadonly'] ?? null;
        $this->youtubeUpload = $values['youtubeUpload'] ?? null;
        $this->youtubepartner = $values['youtubepartner'] ?? null;
    }

    /**
     * @return ?array<string>
     */
    public function getAllowedAudiences(): ?array
    {
        return $this->allowedAudiences;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAllowedAudiences(?array $value = null): self
    {
        $this->allowedAudiences = $value;
        $this->_setField('allowedAudiences');
        return $this;
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
     * @return ?string
     */
    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    /**
     * @param ?string $value
     */
    public function setIconUrl(?string $value = null): self
    {
        $this->iconUrl = $value;
        $this->_setField('iconUrl');
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
    public function getAdsenseManagement(): ?bool
    {
        return $this->adsenseManagement;
    }

    /**
     * @param ?bool $value
     */
    public function setAdsenseManagement(?bool $value = null): self
    {
        $this->adsenseManagement = $value;
        $this->_setField('adsenseManagement');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAnalytics(): ?bool
    {
        return $this->analytics;
    }

    /**
     * @param ?bool $value
     */
    public function setAnalytics(?bool $value = null): self
    {
        $this->analytics = $value;
        $this->_setField('analytics');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBlogger(): ?bool
    {
        return $this->blogger;
    }

    /**
     * @param ?bool $value
     */
    public function setBlogger(?bool $value = null): self
    {
        $this->blogger = $value;
        $this->_setField('blogger');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCalendar(): ?bool
    {
        return $this->calendar;
    }

    /**
     * @param ?bool $value
     */
    public function setCalendar(?bool $value = null): self
    {
        $this->calendar = $value;
        $this->_setField('calendar');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCalendarAddonsExecute(): ?bool
    {
        return $this->calendarAddonsExecute;
    }

    /**
     * @param ?bool $value
     */
    public function setCalendarAddonsExecute(?bool $value = null): self
    {
        $this->calendarAddonsExecute = $value;
        $this->_setField('calendarAddonsExecute');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCalendarEvents(): ?bool
    {
        return $this->calendarEvents;
    }

    /**
     * @param ?bool $value
     */
    public function setCalendarEvents(?bool $value = null): self
    {
        $this->calendarEvents = $value;
        $this->_setField('calendarEvents');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCalendarEventsReadonly(): ?bool
    {
        return $this->calendarEventsReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setCalendarEventsReadonly(?bool $value = null): self
    {
        $this->calendarEventsReadonly = $value;
        $this->_setField('calendarEventsReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCalendarSettingsReadonly(): ?bool
    {
        return $this->calendarSettingsReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setCalendarSettingsReadonly(?bool $value = null): self
    {
        $this->calendarSettingsReadonly = $value;
        $this->_setField('calendarSettingsReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getChromeWebStore(): ?bool
    {
        return $this->chromeWebStore;
    }

    /**
     * @param ?bool $value
     */
    public function setChromeWebStore(?bool $value = null): self
    {
        $this->chromeWebStore = $value;
        $this->_setField('chromeWebStore');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContacts(): ?bool
    {
        return $this->contacts;
    }

    /**
     * @param ?bool $value
     */
    public function setContacts(?bool $value = null): self
    {
        $this->contacts = $value;
        $this->_setField('contacts');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContactsNew(): ?bool
    {
        return $this->contactsNew;
    }

    /**
     * @param ?bool $value
     */
    public function setContactsNew(?bool $value = null): self
    {
        $this->contactsNew = $value;
        $this->_setField('contactsNew');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContactsOtherReadonly(): ?bool
    {
        return $this->contactsOtherReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setContactsOtherReadonly(?bool $value = null): self
    {
        $this->contactsOtherReadonly = $value;
        $this->_setField('contactsOtherReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContactsReadonly(): ?bool
    {
        return $this->contactsReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setContactsReadonly(?bool $value = null): self
    {
        $this->contactsReadonly = $value;
        $this->_setField('contactsReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getContentApiForShopping(): ?bool
    {
        return $this->contentApiForShopping;
    }

    /**
     * @param ?bool $value
     */
    public function setContentApiForShopping(?bool $value = null): self
    {
        $this->contentApiForShopping = $value;
        $this->_setField('contentApiForShopping');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCoordinate(): ?bool
    {
        return $this->coordinate;
    }

    /**
     * @param ?bool $value
     */
    public function setCoordinate(?bool $value = null): self
    {
        $this->coordinate = $value;
        $this->_setField('coordinate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCoordinateReadonly(): ?bool
    {
        return $this->coordinateReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setCoordinateReadonly(?bool $value = null): self
    {
        $this->coordinateReadonly = $value;
        $this->_setField('coordinateReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDirectoryReadonly(): ?bool
    {
        return $this->directoryReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setDirectoryReadonly(?bool $value = null): self
    {
        $this->directoryReadonly = $value;
        $this->_setField('directoryReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDocumentList(): ?bool
    {
        return $this->documentList;
    }

    /**
     * @param ?bool $value
     */
    public function setDocumentList(?bool $value = null): self
    {
        $this->documentList = $value;
        $this->_setField('documentList');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDrive(): ?bool
    {
        return $this->drive;
    }

    /**
     * @param ?bool $value
     */
    public function setDrive(?bool $value = null): self
    {
        $this->drive = $value;
        $this->_setField('drive');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDriveActivity(): ?bool
    {
        return $this->driveActivity;
    }

    /**
     * @param ?bool $value
     */
    public function setDriveActivity(?bool $value = null): self
    {
        $this->driveActivity = $value;
        $this->_setField('driveActivity');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDriveActivityReadonly(): ?bool
    {
        return $this->driveActivityReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setDriveActivityReadonly(?bool $value = null): self
    {
        $this->driveActivityReadonly = $value;
        $this->_setField('driveActivityReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDriveAppdata(): ?bool
    {
        return $this->driveAppdata;
    }

    /**
     * @param ?bool $value
     */
    public function setDriveAppdata(?bool $value = null): self
    {
        $this->driveAppdata = $value;
        $this->_setField('driveAppdata');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDriveAppsReadonly(): ?bool
    {
        return $this->driveAppsReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setDriveAppsReadonly(?bool $value = null): self
    {
        $this->driveAppsReadonly = $value;
        $this->_setField('driveAppsReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDriveFile(): ?bool
    {
        return $this->driveFile;
    }

    /**
     * @param ?bool $value
     */
    public function setDriveFile(?bool $value = null): self
    {
        $this->driveFile = $value;
        $this->_setField('driveFile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDriveMetadata(): ?bool
    {
        return $this->driveMetadata;
    }

    /**
     * @param ?bool $value
     */
    public function setDriveMetadata(?bool $value = null): self
    {
        $this->driveMetadata = $value;
        $this->_setField('driveMetadata');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDriveMetadataReadonly(): ?bool
    {
        return $this->driveMetadataReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setDriveMetadataReadonly(?bool $value = null): self
    {
        $this->driveMetadataReadonly = $value;
        $this->_setField('driveMetadataReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDrivePhotosReadonly(): ?bool
    {
        return $this->drivePhotosReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setDrivePhotosReadonly(?bool $value = null): self
    {
        $this->drivePhotosReadonly = $value;
        $this->_setField('drivePhotosReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDriveReadonly(): ?bool
    {
        return $this->driveReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setDriveReadonly(?bool $value = null): self
    {
        $this->driveReadonly = $value;
        $this->_setField('driveReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDriveScripts(): ?bool
    {
        return $this->driveScripts;
    }

    /**
     * @param ?bool $value
     */
    public function setDriveScripts(?bool $value = null): self
    {
        $this->driveScripts = $value;
        $this->_setField('driveScripts');
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
    public function getGmail(): ?bool
    {
        return $this->gmail;
    }

    /**
     * @param ?bool $value
     */
    public function setGmail(?bool $value = null): self
    {
        $this->gmail = $value;
        $this->_setField('gmail');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailCompose(): ?bool
    {
        return $this->gmailCompose;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailCompose(?bool $value = null): self
    {
        $this->gmailCompose = $value;
        $this->_setField('gmailCompose');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailInsert(): ?bool
    {
        return $this->gmailInsert;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailInsert(?bool $value = null): self
    {
        $this->gmailInsert = $value;
        $this->_setField('gmailInsert');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailLabels(): ?bool
    {
        return $this->gmailLabels;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailLabels(?bool $value = null): self
    {
        $this->gmailLabels = $value;
        $this->_setField('gmailLabels');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailMetadata(): ?bool
    {
        return $this->gmailMetadata;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailMetadata(?bool $value = null): self
    {
        $this->gmailMetadata = $value;
        $this->_setField('gmailMetadata');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailModify(): ?bool
    {
        return $this->gmailModify;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailModify(?bool $value = null): self
    {
        $this->gmailModify = $value;
        $this->_setField('gmailModify');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailNew(): ?bool
    {
        return $this->gmailNew;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailNew(?bool $value = null): self
    {
        $this->gmailNew = $value;
        $this->_setField('gmailNew');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailReadonly(): ?bool
    {
        return $this->gmailReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailReadonly(?bool $value = null): self
    {
        $this->gmailReadonly = $value;
        $this->_setField('gmailReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailSend(): ?bool
    {
        return $this->gmailSend;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailSend(?bool $value = null): self
    {
        $this->gmailSend = $value;
        $this->_setField('gmailSend');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailSettingsBasic(): ?bool
    {
        return $this->gmailSettingsBasic;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailSettingsBasic(?bool $value = null): self
    {
        $this->gmailSettingsBasic = $value;
        $this->_setField('gmailSettingsBasic');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGmailSettingsSharing(): ?bool
    {
        return $this->gmailSettingsSharing;
    }

    /**
     * @param ?bool $value
     */
    public function setGmailSettingsSharing(?bool $value = null): self
    {
        $this->gmailSettingsSharing = $value;
        $this->_setField('gmailSettingsSharing');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGoogleAffiliateNetwork(): ?bool
    {
        return $this->googleAffiliateNetwork;
    }

    /**
     * @param ?bool $value
     */
    public function setGoogleAffiliateNetwork(?bool $value = null): self
    {
        $this->googleAffiliateNetwork = $value;
        $this->_setField('googleAffiliateNetwork');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGoogleBooks(): ?bool
    {
        return $this->googleBooks;
    }

    /**
     * @param ?bool $value
     */
    public function setGoogleBooks(?bool $value = null): self
    {
        $this->googleBooks = $value;
        $this->_setField('googleBooks');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGoogleCloudStorage(): ?bool
    {
        return $this->googleCloudStorage;
    }

    /**
     * @param ?bool $value
     */
    public function setGoogleCloudStorage(?bool $value = null): self
    {
        $this->googleCloudStorage = $value;
        $this->_setField('googleCloudStorage');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGoogleDrive(): ?bool
    {
        return $this->googleDrive;
    }

    /**
     * @param ?bool $value
     */
    public function setGoogleDrive(?bool $value = null): self
    {
        $this->googleDrive = $value;
        $this->_setField('googleDrive');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGoogleDriveFiles(): ?bool
    {
        return $this->googleDriveFiles;
    }

    /**
     * @param ?bool $value
     */
    public function setGoogleDriveFiles(?bool $value = null): self
    {
        $this->googleDriveFiles = $value;
        $this->_setField('googleDriveFiles');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGooglePlus(): ?bool
    {
        return $this->googlePlus;
    }

    /**
     * @param ?bool $value
     */
    public function setGooglePlus(?bool $value = null): self
    {
        $this->googlePlus = $value;
        $this->_setField('googlePlus');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getLatitudeBest(): ?bool
    {
        return $this->latitudeBest;
    }

    /**
     * @param ?bool $value
     */
    public function setLatitudeBest(?bool $value = null): self
    {
        $this->latitudeBest = $value;
        $this->_setField('latitudeBest');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getLatitudeCity(): ?bool
    {
        return $this->latitudeCity;
    }

    /**
     * @param ?bool $value
     */
    public function setLatitudeCity(?bool $value = null): self
    {
        $this->latitudeCity = $value;
        $this->_setField('latitudeCity');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getModerator(): ?bool
    {
        return $this->moderator;
    }

    /**
     * @param ?bool $value
     */
    public function setModerator(?bool $value = null): self
    {
        $this->moderator = $value;
        $this->_setField('moderator');
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
    public function getOrkut(): ?bool
    {
        return $this->orkut;
    }

    /**
     * @param ?bool $value
     */
    public function setOrkut(?bool $value = null): self
    {
        $this->orkut = $value;
        $this->_setField('orkut');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPicasaWeb(): ?bool
    {
        return $this->picasaWeb;
    }

    /**
     * @param ?bool $value
     */
    public function setPicasaWeb(?bool $value = null): self
    {
        $this->picasaWeb = $value;
        $this->_setField('picasaWeb');
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
    public function getSites(): ?bool
    {
        return $this->sites;
    }

    /**
     * @param ?bool $value
     */
    public function setSites(?bool $value = null): self
    {
        $this->sites = $value;
        $this->_setField('sites');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getTasks(): ?bool
    {
        return $this->tasks;
    }

    /**
     * @param ?bool $value
     */
    public function setTasks(?bool $value = null): self
    {
        $this->tasks = $value;
        $this->_setField('tasks');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getTasksReadonly(): ?bool
    {
        return $this->tasksReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setTasksReadonly(?bool $value = null): self
    {
        $this->tasksReadonly = $value;
        $this->_setField('tasksReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUrlShortener(): ?bool
    {
        return $this->urlShortener;
    }

    /**
     * @param ?bool $value
     */
    public function setUrlShortener(?bool $value = null): self
    {
        $this->urlShortener = $value;
        $this->_setField('urlShortener');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getWebmasterTools(): ?bool
    {
        return $this->webmasterTools;
    }

    /**
     * @param ?bool $value
     */
    public function setWebmasterTools(?bool $value = null): self
    {
        $this->webmasterTools = $value;
        $this->_setField('webmasterTools');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getYoutube(): ?bool
    {
        return $this->youtube;
    }

    /**
     * @param ?bool $value
     */
    public function setYoutube(?bool $value = null): self
    {
        $this->youtube = $value;
        $this->_setField('youtube');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getYoutubeChannelmembershipsCreator(): ?bool
    {
        return $this->youtubeChannelmembershipsCreator;
    }

    /**
     * @param ?bool $value
     */
    public function setYoutubeChannelmembershipsCreator(?bool $value = null): self
    {
        $this->youtubeChannelmembershipsCreator = $value;
        $this->_setField('youtubeChannelmembershipsCreator');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getYoutubeNew(): ?bool
    {
        return $this->youtubeNew;
    }

    /**
     * @param ?bool $value
     */
    public function setYoutubeNew(?bool $value = null): self
    {
        $this->youtubeNew = $value;
        $this->_setField('youtubeNew');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getYoutubeReadonly(): ?bool
    {
        return $this->youtubeReadonly;
    }

    /**
     * @param ?bool $value
     */
    public function setYoutubeReadonly(?bool $value = null): self
    {
        $this->youtubeReadonly = $value;
        $this->_setField('youtubeReadonly');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getYoutubeUpload(): ?bool
    {
        return $this->youtubeUpload;
    }

    /**
     * @param ?bool $value
     */
    public function setYoutubeUpload(?bool $value = null): self
    {
        $this->youtubeUpload = $value;
        $this->_setField('youtubeUpload');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getYoutubepartner(): ?bool
    {
        return $this->youtubepartner;
    }

    /**
     * @param ?bool $value
     */
    public function setYoutubepartner(?bool $value = null): self
    {
        $this->youtubepartner = $value;
        $this->_setField('youtubepartner');
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
