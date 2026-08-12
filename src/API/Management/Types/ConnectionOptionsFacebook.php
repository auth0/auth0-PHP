<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'facebook' connection
 */
class ConnectionOptionsFacebook extends JsonSerializableType
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
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class)])]
    private ?array $upstreamParams;

    /**
     * @var ?string $scope
     */
    #[JsonProperty('scope')]
    private ?string $scope;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?bool $adsManagement Grants permission to both read and manage ads for ad accounts you own or have been granted access to by the owner. By default, your app may only access ad accounts owned by admins of the app when in developer mode.
     */
    #[JsonProperty('ads_management')]
    private ?bool $adsManagement;

    /**
     * @var ?bool $adsRead Grants access to the Ads Insights API to pull ads report information for ad accounts you own or have been granted access to by the owner of other ad accounts.
     */
    #[JsonProperty('ads_read')]
    private ?bool $adsRead;

    /**
     * @var ?bool $allowContextProfileField Provides access to a social context. Deprecated on April 30th, 2019.
     */
    #[JsonProperty('allow_context_profile_field')]
    private ?bool $allowContextProfileField;

    /**
     * @var ?bool $businessManagement Grants permission to read and write with the Business Manager API.
     */
    #[JsonProperty('business_management')]
    private ?bool $businessManagement;

    /**
     * @var ?bool $email Grants permission to access a person's primary email address.
     */
    #[JsonProperty('email')]
    private ?bool $email;

    /**
     * @var ?bool $groupsAccessMemberInfo Grants permission to publicly available group member information.
     */
    #[JsonProperty('groups_access_member_info')]
    private ?bool $groupsAccessMemberInfo;

    /**
     * @var ?bool $leadsRetrieval Grants permission to retrieve all the information captured within a lead.
     */
    #[JsonProperty('leads_retrieval')]
    private ?bool $leadsRetrieval;

    /**
     * @var ?bool $manageNotifications Enables your app to read a person's notifications and mark them as read. This permission does not let you send notifications to a person. Deprecated in Graph API v2.3.
     */
    #[JsonProperty('manage_notifications')]
    private ?bool $manageNotifications;

    /**
     * @var ?bool $managePages Grants permission to retrieve Page Access Tokens for the Pages and Apps that the person administers. Apps need both manage_pages and publish_pages to be able to publish as a Page.
     */
    #[JsonProperty('manage_pages')]
    private ?bool $managePages;

    /**
     * @var ?bool $pagesManageCta Allows the app to perform POST and DELETE operations on endpoints used for managing a Page's Call To Action buttons.
     */
    #[JsonProperty('pages_manage_cta')]
    private ?bool $pagesManageCta;

    /**
     * @var ?bool $pagesManageInstantArticles Grants permission to manage Instant Articles on behalf of Facebook Pages administered by people using your app.
     */
    #[JsonProperty('pages_manage_instant_articles')]
    private ?bool $pagesManageInstantArticles;

    /**
     * @var ?bool $pagesMessaging Grants permission to send and receive messages through a Facebook Page.
     */
    #[JsonProperty('pages_messaging')]
    private ?bool $pagesMessaging;

    /**
     * @var ?bool $pagesMessagingPhoneNumber Grants permission to use the phone number messaging feature.
     */
    #[JsonProperty('pages_messaging_phone_number')]
    private ?bool $pagesMessagingPhoneNumber;

    /**
     * @var ?bool $pagesMessagingSubscriptions Grants permission to send messages using Facebook Pages at any time after the first user interaction. Your app may only send advertising or promotional content through sponsored messages or within 24 hours of user interaction.
     */
    #[JsonProperty('pages_messaging_subscriptions')]
    private ?bool $pagesMessagingSubscriptions;

    /**
     * @var ?bool $pagesShowList Grants access to show the list of the Pages that a person manages.
     */
    #[JsonProperty('pages_show_list')]
    private ?bool $pagesShowList;

    /**
     * @var ?bool $publicProfile Provides access to a user's public profile information including id, first_name, last_name, middle_name, name, name_format, picture, and short_name. This is the most basic permission and is required by Facebook.
     */
    #[JsonProperty('public_profile')]
    private ?bool $publicProfile;

    /**
     * @var ?bool $publishActions Allows your app to publish to the Open Graph using Built-in Actions, Achievements, Scores, or Custom Actions. Deprecated on August 1st, 2018.
     */
    #[JsonProperty('publish_actions')]
    private ?bool $publishActions;

    /**
     * @var ?bool $publishPages Grants permission to publish posts, comments, and like Pages managed by a person using your app. Your app must also have manage_pages to publish as a Page.
     */
    #[JsonProperty('publish_pages')]
    private ?bool $publishPages;

    /**
     * @var ?bool $publishToGroups Grants permission to post content into a group on behalf of a user who has granted the app this permission.
     */
    #[JsonProperty('publish_to_groups')]
    private ?bool $publishToGroups;

    /**
     * @var ?bool $publishVideo Grants permission to publish live videos to the app User's timeline.
     */
    #[JsonProperty('publish_video')]
    private ?bool $publishVideo;

    /**
     * @var ?bool $readAudienceNetworkInsights Grants read-only access to the Audience Network Insights data for Apps the person owns.
     */
    #[JsonProperty('read_audience_network_insights')]
    private ?bool $readAudienceNetworkInsights;

    /**
     * @var ?bool $readInsights Grants read-only access to the Insights data for Pages, Apps, and web domains the person owns.
     */
    #[JsonProperty('read_insights')]
    private ?bool $readInsights;

    /**
     * @var ?bool $readMailbox Provides the ability to read the messages in a person's Facebook Inbox through the inbox edge and the thread node. Deprecated in Graph API v2.3.
     */
    #[JsonProperty('read_mailbox')]
    private ?bool $readMailbox;

    /**
     * @var ?bool $readPageMailboxes Grants permission to read from the Page Inboxes of the Pages managed by a person. This permission is often used alongside the manage_pages permission.
     */
    #[JsonProperty('read_page_mailboxes')]
    private ?bool $readPageMailboxes;

    /**
     * @var ?bool $readStream Provides access to read the posts in a person's News Feed, or the posts on their Profile. Deprecated in Graph API v2.3.
     */
    #[JsonProperty('read_stream')]
    private ?bool $readStream;

    /**
     * @var ?bool $userAgeRange Grants permission to access a person's age range.
     */
    #[JsonProperty('user_age_range')]
    private ?bool $userAgeRange;

    /**
     * @var ?bool $userBirthday Grants permission to access a person's birthday.
     */
    #[JsonProperty('user_birthday')]
    private ?bool $userBirthday;

    /**
     * @var ?bool $userEvents Grants read-only access to the Events a person is a host of or has RSVPed to. This permission is restricted to a limited set of partners and usage requires prior approval by Facebook.
     */
    #[JsonProperty('user_events')]
    private ?bool $userEvents;

    /**
     * @var ?bool $userFriends Grants permission to access a list of friends that also use said app. This permission is restricted to a limited set of partners and usage requires prior approval by Facebook.
     */
    #[JsonProperty('user_friends')]
    private ?bool $userFriends;

    /**
     * @var ?bool $userGender Grants permission to access a person's gender.
     */
    #[JsonProperty('user_gender')]
    private ?bool $userGender;

    /**
     * @var ?bool $userGroups Enables your app to read the Groups a person is a member of through the groups edge on the User object. Deprecated in Graph API v2.3.
     */
    #[JsonProperty('user_groups')]
    private ?bool $userGroups;

    /**
     * @var ?bool $userHometown Grants permission to access a person's hometown location set in their User Profile.
     */
    #[JsonProperty('user_hometown')]
    private ?bool $userHometown;

    /**
     * @var ?bool $userLikes Grants permission to access the list of all Facebook Pages that a person has liked.
     */
    #[JsonProperty('user_likes')]
    private ?bool $userLikes;

    /**
     * @var ?bool $userLink Grants permission to access the Facebook Profile URL of the user of your app.
     */
    #[JsonProperty('user_link')]
    private ?bool $userLink;

    /**
     * @var ?bool $userLocation Provides access to a person's current city through the location field on the User object. The current city is set by a person on their Profile.
     */
    #[JsonProperty('user_location')]
    private ?bool $userLocation;

    /**
     * @var ?bool $userManagedGroups Enables your app to read the Groups a person is an admin of through the groups edge on the User object. Deprecated in Graph API v3.0.
     */
    #[JsonProperty('user_managed_groups')]
    private ?bool $userManagedGroups;

    /**
     * @var ?bool $userPhotos Provides access to the photos a person has uploaded or been tagged in. This permission is restricted to a limited set of partners and usage requires prior approval by Facebook.
     */
    #[JsonProperty('user_photos')]
    private ?bool $userPhotos;

    /**
     * @var ?bool $userPosts Provides access to the posts on a person's Timeline including their own posts, posts they are tagged in, and posts other people make on their Timeline. This permission is restricted to a limited set of partners and usage requires prior approval by Facebook.
     */
    #[JsonProperty('user_posts')]
    private ?bool $userPosts;

    /**
     * @var ?bool $userStatus Provides access to a person's statuses. These are posts on Facebook which don't include links, videos or photos. Deprecated in Graph API v2.3.
     */
    #[JsonProperty('user_status')]
    private ?bool $userStatus;

    /**
     * @var ?bool $userTaggedPlaces Provides access to the Places a person has been tagged at in photos, videos, statuses and links. This permission is restricted to a limited set of partners and usage requires prior approval by Facebook.
     */
    #[JsonProperty('user_tagged_places')]
    private ?bool $userTaggedPlaces;

    /**
     * @var ?bool $userVideos Provides access to the videos a person has uploaded or been tagged in. This permission is restricted to a limited set of partners and usage requires prior approval by Facebook.
     */
    #[JsonProperty('user_videos')]
    private ?bool $userVideos;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   freeformScopes?: ?array<string>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )>,
     *   scope?: ?string,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   adsManagement?: ?bool,
     *   adsRead?: ?bool,
     *   allowContextProfileField?: ?bool,
     *   businessManagement?: ?bool,
     *   email?: ?bool,
     *   groupsAccessMemberInfo?: ?bool,
     *   leadsRetrieval?: ?bool,
     *   manageNotifications?: ?bool,
     *   managePages?: ?bool,
     *   pagesManageCta?: ?bool,
     *   pagesManageInstantArticles?: ?bool,
     *   pagesMessaging?: ?bool,
     *   pagesMessagingPhoneNumber?: ?bool,
     *   pagesMessagingSubscriptions?: ?bool,
     *   pagesShowList?: ?bool,
     *   publicProfile?: ?bool,
     *   publishActions?: ?bool,
     *   publishPages?: ?bool,
     *   publishToGroups?: ?bool,
     *   publishVideo?: ?bool,
     *   readAudienceNetworkInsights?: ?bool,
     *   readInsights?: ?bool,
     *   readMailbox?: ?bool,
     *   readPageMailboxes?: ?bool,
     *   readStream?: ?bool,
     *   userAgeRange?: ?bool,
     *   userBirthday?: ?bool,
     *   userEvents?: ?bool,
     *   userFriends?: ?bool,
     *   userGender?: ?bool,
     *   userGroups?: ?bool,
     *   userHometown?: ?bool,
     *   userLikes?: ?bool,
     *   userLink?: ?bool,
     *   userLocation?: ?bool,
     *   userManagedGroups?: ?bool,
     *   userPhotos?: ?bool,
     *   userPosts?: ?bool,
     *   userStatus?: ?bool,
     *   userTaggedPlaces?: ?bool,
     *   userVideos?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->freeformScopes = $values['freeformScopes'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->adsManagement = $values['adsManagement'] ?? null;
        $this->adsRead = $values['adsRead'] ?? null;
        $this->allowContextProfileField = $values['allowContextProfileField'] ?? null;
        $this->businessManagement = $values['businessManagement'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->groupsAccessMemberInfo = $values['groupsAccessMemberInfo'] ?? null;
        $this->leadsRetrieval = $values['leadsRetrieval'] ?? null;
        $this->manageNotifications = $values['manageNotifications'] ?? null;
        $this->managePages = $values['managePages'] ?? null;
        $this->pagesManageCta = $values['pagesManageCta'] ?? null;
        $this->pagesManageInstantArticles = $values['pagesManageInstantArticles'] ?? null;
        $this->pagesMessaging = $values['pagesMessaging'] ?? null;
        $this->pagesMessagingPhoneNumber = $values['pagesMessagingPhoneNumber'] ?? null;
        $this->pagesMessagingSubscriptions = $values['pagesMessagingSubscriptions'] ?? null;
        $this->pagesShowList = $values['pagesShowList'] ?? null;
        $this->publicProfile = $values['publicProfile'] ?? null;
        $this->publishActions = $values['publishActions'] ?? null;
        $this->publishPages = $values['publishPages'] ?? null;
        $this->publishToGroups = $values['publishToGroups'] ?? null;
        $this->publishVideo = $values['publishVideo'] ?? null;
        $this->readAudienceNetworkInsights = $values['readAudienceNetworkInsights'] ?? null;
        $this->readInsights = $values['readInsights'] ?? null;
        $this->readMailbox = $values['readMailbox'] ?? null;
        $this->readPageMailboxes = $values['readPageMailboxes'] ?? null;
        $this->readStream = $values['readStream'] ?? null;
        $this->userAgeRange = $values['userAgeRange'] ?? null;
        $this->userBirthday = $values['userBirthday'] ?? null;
        $this->userEvents = $values['userEvents'] ?? null;
        $this->userFriends = $values['userFriends'] ?? null;
        $this->userGender = $values['userGender'] ?? null;
        $this->userGroups = $values['userGroups'] ?? null;
        $this->userHometown = $values['userHometown'] ?? null;
        $this->userLikes = $values['userLikes'] ?? null;
        $this->userLink = $values['userLink'] ?? null;
        $this->userLocation = $values['userLocation'] ?? null;
        $this->userManagedGroups = $values['userManagedGroups'] ?? null;
        $this->userPhotos = $values['userPhotos'] ?? null;
        $this->userPosts = $values['userPosts'] ?? null;
        $this->userStatus = $values['userStatus'] ?? null;
        $this->userTaggedPlaces = $values['userTaggedPlaces'] ?? null;
        $this->userVideos = $values['userVideos'] ?? null;
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
     * @return ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )>
     */
    public function getUpstreamParams(): ?array
    {
        return $this->upstreamParams;
    }

    /**
     * @param ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )> $value
     */
    public function setUpstreamParams(?array $value = null): self
    {
        $this->upstreamParams = $value;
        $this->_setField('upstreamParams');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param ?string $value
     */
    public function setScope(?string $value = null): self
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
     * @return ?bool
     */
    public function getAdsManagement(): ?bool
    {
        return $this->adsManagement;
    }

    /**
     * @param ?bool $value
     */
    public function setAdsManagement(?bool $value = null): self
    {
        $this->adsManagement = $value;
        $this->_setField('adsManagement');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAdsRead(): ?bool
    {
        return $this->adsRead;
    }

    /**
     * @param ?bool $value
     */
    public function setAdsRead(?bool $value = null): self
    {
        $this->adsRead = $value;
        $this->_setField('adsRead');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowContextProfileField(): ?bool
    {
        return $this->allowContextProfileField;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowContextProfileField(?bool $value = null): self
    {
        $this->allowContextProfileField = $value;
        $this->_setField('allowContextProfileField');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBusinessManagement(): ?bool
    {
        return $this->businessManagement;
    }

    /**
     * @param ?bool $value
     */
    public function setBusinessManagement(?bool $value = null): self
    {
        $this->businessManagement = $value;
        $this->_setField('businessManagement');
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
    public function getGroupsAccessMemberInfo(): ?bool
    {
        return $this->groupsAccessMemberInfo;
    }

    /**
     * @param ?bool $value
     */
    public function setGroupsAccessMemberInfo(?bool $value = null): self
    {
        $this->groupsAccessMemberInfo = $value;
        $this->_setField('groupsAccessMemberInfo');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getLeadsRetrieval(): ?bool
    {
        return $this->leadsRetrieval;
    }

    /**
     * @param ?bool $value
     */
    public function setLeadsRetrieval(?bool $value = null): self
    {
        $this->leadsRetrieval = $value;
        $this->_setField('leadsRetrieval');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getManageNotifications(): ?bool
    {
        return $this->manageNotifications;
    }

    /**
     * @param ?bool $value
     */
    public function setManageNotifications(?bool $value = null): self
    {
        $this->manageNotifications = $value;
        $this->_setField('manageNotifications');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getManagePages(): ?bool
    {
        return $this->managePages;
    }

    /**
     * @param ?bool $value
     */
    public function setManagePages(?bool $value = null): self
    {
        $this->managePages = $value;
        $this->_setField('managePages');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPagesManageCta(): ?bool
    {
        return $this->pagesManageCta;
    }

    /**
     * @param ?bool $value
     */
    public function setPagesManageCta(?bool $value = null): self
    {
        $this->pagesManageCta = $value;
        $this->_setField('pagesManageCta');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPagesManageInstantArticles(): ?bool
    {
        return $this->pagesManageInstantArticles;
    }

    /**
     * @param ?bool $value
     */
    public function setPagesManageInstantArticles(?bool $value = null): self
    {
        $this->pagesManageInstantArticles = $value;
        $this->_setField('pagesManageInstantArticles');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPagesMessaging(): ?bool
    {
        return $this->pagesMessaging;
    }

    /**
     * @param ?bool $value
     */
    public function setPagesMessaging(?bool $value = null): self
    {
        $this->pagesMessaging = $value;
        $this->_setField('pagesMessaging');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPagesMessagingPhoneNumber(): ?bool
    {
        return $this->pagesMessagingPhoneNumber;
    }

    /**
     * @param ?bool $value
     */
    public function setPagesMessagingPhoneNumber(?bool $value = null): self
    {
        $this->pagesMessagingPhoneNumber = $value;
        $this->_setField('pagesMessagingPhoneNumber');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPagesMessagingSubscriptions(): ?bool
    {
        return $this->pagesMessagingSubscriptions;
    }

    /**
     * @param ?bool $value
     */
    public function setPagesMessagingSubscriptions(?bool $value = null): self
    {
        $this->pagesMessagingSubscriptions = $value;
        $this->_setField('pagesMessagingSubscriptions');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPagesShowList(): ?bool
    {
        return $this->pagesShowList;
    }

    /**
     * @param ?bool $value
     */
    public function setPagesShowList(?bool $value = null): self
    {
        $this->pagesShowList = $value;
        $this->_setField('pagesShowList');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPublicProfile(): ?bool
    {
        return $this->publicProfile;
    }

    /**
     * @param ?bool $value
     */
    public function setPublicProfile(?bool $value = null): self
    {
        $this->publicProfile = $value;
        $this->_setField('publicProfile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPublishActions(): ?bool
    {
        return $this->publishActions;
    }

    /**
     * @param ?bool $value
     */
    public function setPublishActions(?bool $value = null): self
    {
        $this->publishActions = $value;
        $this->_setField('publishActions');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPublishPages(): ?bool
    {
        return $this->publishPages;
    }

    /**
     * @param ?bool $value
     */
    public function setPublishPages(?bool $value = null): self
    {
        $this->publishPages = $value;
        $this->_setField('publishPages');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPublishToGroups(): ?bool
    {
        return $this->publishToGroups;
    }

    /**
     * @param ?bool $value
     */
    public function setPublishToGroups(?bool $value = null): self
    {
        $this->publishToGroups = $value;
        $this->_setField('publishToGroups');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPublishVideo(): ?bool
    {
        return $this->publishVideo;
    }

    /**
     * @param ?bool $value
     */
    public function setPublishVideo(?bool $value = null): self
    {
        $this->publishVideo = $value;
        $this->_setField('publishVideo');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReadAudienceNetworkInsights(): ?bool
    {
        return $this->readAudienceNetworkInsights;
    }

    /**
     * @param ?bool $value
     */
    public function setReadAudienceNetworkInsights(?bool $value = null): self
    {
        $this->readAudienceNetworkInsights = $value;
        $this->_setField('readAudienceNetworkInsights');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReadInsights(): ?bool
    {
        return $this->readInsights;
    }

    /**
     * @param ?bool $value
     */
    public function setReadInsights(?bool $value = null): self
    {
        $this->readInsights = $value;
        $this->_setField('readInsights');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReadMailbox(): ?bool
    {
        return $this->readMailbox;
    }

    /**
     * @param ?bool $value
     */
    public function setReadMailbox(?bool $value = null): self
    {
        $this->readMailbox = $value;
        $this->_setField('readMailbox');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReadPageMailboxes(): ?bool
    {
        return $this->readPageMailboxes;
    }

    /**
     * @param ?bool $value
     */
    public function setReadPageMailboxes(?bool $value = null): self
    {
        $this->readPageMailboxes = $value;
        $this->_setField('readPageMailboxes');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReadStream(): ?bool
    {
        return $this->readStream;
    }

    /**
     * @param ?bool $value
     */
    public function setReadStream(?bool $value = null): self
    {
        $this->readStream = $value;
        $this->_setField('readStream');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserAgeRange(): ?bool
    {
        return $this->userAgeRange;
    }

    /**
     * @param ?bool $value
     */
    public function setUserAgeRange(?bool $value = null): self
    {
        $this->userAgeRange = $value;
        $this->_setField('userAgeRange');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserBirthday(): ?bool
    {
        return $this->userBirthday;
    }

    /**
     * @param ?bool $value
     */
    public function setUserBirthday(?bool $value = null): self
    {
        $this->userBirthday = $value;
        $this->_setField('userBirthday');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserEvents(): ?bool
    {
        return $this->userEvents;
    }

    /**
     * @param ?bool $value
     */
    public function setUserEvents(?bool $value = null): self
    {
        $this->userEvents = $value;
        $this->_setField('userEvents');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserFriends(): ?bool
    {
        return $this->userFriends;
    }

    /**
     * @param ?bool $value
     */
    public function setUserFriends(?bool $value = null): self
    {
        $this->userFriends = $value;
        $this->_setField('userFriends');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserGender(): ?bool
    {
        return $this->userGender;
    }

    /**
     * @param ?bool $value
     */
    public function setUserGender(?bool $value = null): self
    {
        $this->userGender = $value;
        $this->_setField('userGender');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserGroups(): ?bool
    {
        return $this->userGroups;
    }

    /**
     * @param ?bool $value
     */
    public function setUserGroups(?bool $value = null): self
    {
        $this->userGroups = $value;
        $this->_setField('userGroups');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserHometown(): ?bool
    {
        return $this->userHometown;
    }

    /**
     * @param ?bool $value
     */
    public function setUserHometown(?bool $value = null): self
    {
        $this->userHometown = $value;
        $this->_setField('userHometown');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserLikes(): ?bool
    {
        return $this->userLikes;
    }

    /**
     * @param ?bool $value
     */
    public function setUserLikes(?bool $value = null): self
    {
        $this->userLikes = $value;
        $this->_setField('userLikes');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserLink(): ?bool
    {
        return $this->userLink;
    }

    /**
     * @param ?bool $value
     */
    public function setUserLink(?bool $value = null): self
    {
        $this->userLink = $value;
        $this->_setField('userLink');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserLocation(): ?bool
    {
        return $this->userLocation;
    }

    /**
     * @param ?bool $value
     */
    public function setUserLocation(?bool $value = null): self
    {
        $this->userLocation = $value;
        $this->_setField('userLocation');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserManagedGroups(): ?bool
    {
        return $this->userManagedGroups;
    }

    /**
     * @param ?bool $value
     */
    public function setUserManagedGroups(?bool $value = null): self
    {
        $this->userManagedGroups = $value;
        $this->_setField('userManagedGroups');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserPhotos(): ?bool
    {
        return $this->userPhotos;
    }

    /**
     * @param ?bool $value
     */
    public function setUserPhotos(?bool $value = null): self
    {
        $this->userPhotos = $value;
        $this->_setField('userPhotos');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserPosts(): ?bool
    {
        return $this->userPosts;
    }

    /**
     * @param ?bool $value
     */
    public function setUserPosts(?bool $value = null): self
    {
        $this->userPosts = $value;
        $this->_setField('userPosts');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserStatus(): ?bool
    {
        return $this->userStatus;
    }

    /**
     * @param ?bool $value
     */
    public function setUserStatus(?bool $value = null): self
    {
        $this->userStatus = $value;
        $this->_setField('userStatus');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserTaggedPlaces(): ?bool
    {
        return $this->userTaggedPlaces;
    }

    /**
     * @param ?bool $value
     */
    public function setUserTaggedPlaces(?bool $value = null): self
    {
        $this->userTaggedPlaces = $value;
        $this->_setField('userTaggedPlaces');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUserVideos(): ?bool
    {
        return $this->userVideos;
    }

    /**
     * @param ?bool $value
     */
    public function setUserVideos(?bool $value = null): self
    {
        $this->userVideos = $value;
        $this->_setField('userVideos');
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
