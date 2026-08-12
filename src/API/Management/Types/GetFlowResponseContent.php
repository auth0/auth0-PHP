<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class GetFlowResponseContent extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?array<(
     *    FlowActionActivecampaignListContacts
     *   |FlowActionActivecampaignUpsertContact
     *   |FlowActionAirtableCreateRecord
     *   |FlowActionAirtableListRecords
     *   |FlowActionAirtableUpdateRecord
     *   |FlowActionAuth0CreateUser
     *   |FlowActionAuth0GetUser
     *   |FlowActionAuth0UpdateUser
     *   |FlowActionAuth0SendRequest
     *   |FlowActionAuth0SendEmail
     *   |FlowActionAuth0SendSms
     *   |FlowActionAuth0MakeCall
     *   |FlowActionBigqueryInsertRows
     *   |FlowActionClearbitFindPerson
     *   |FlowActionClearbitFindCompany
     *   |FlowActionEmailVerifyEmail
     *   |FlowActionFlowBooleanCondition
     *   |FlowActionFlowDelayFlow
     *   |FlowActionFlowDoNothing
     *   |FlowActionFlowErrorMessage
     *   |FlowActionFlowMapValue
     *   |FlowActionFlowReturnJson
     *   |FlowActionFlowStoreVars
     *   |FlowActionGoogleSheetsAddRow
     *   |FlowActionHttpSendRequest
     *   |FlowActionHubspotEnrollContact
     *   |FlowActionHubspotGetContact
     *   |FlowActionHubspotUpsertContact
     *   |FlowActionJsonCreateJson
     *   |FlowActionJsonParseJson
     *   |FlowActionJsonSerializeJson
     *   |FlowActionJwtDecodeJwt
     *   |FlowActionJwtSignJwt
     *   |FlowActionJwtVerifyJwt
     *   |FlowActionMailchimpUpsertMember
     *   |FlowActionMailjetSendEmail
     *   |FlowActionOtpGenerateCode
     *   |FlowActionOtpVerifyCode
     *   |FlowActionPipedriveAddDeal
     *   |FlowActionPipedriveAddOrganization
     *   |FlowActionPipedriveAddPerson
     *   |FlowActionSalesforceCreateLead
     *   |FlowActionSalesforceGetLead
     *   |FlowActionSalesforceSearchLeads
     *   |FlowActionSalesforceUpdateLead
     *   |FlowActionSendgridSendEmail
     *   |FlowActionSlackPostMessage
     *   |FlowActionStripeAddTaxId
     *   |FlowActionStripeCreateCustomer
     *   |FlowActionStripeCreatePortalSession
     *   |FlowActionStripeDeleteTaxId
     *   |FlowActionStripeFindCustomers
     *   |FlowActionStripeGetCustomer
     *   |FlowActionStripeUpdateCustomer
     *   |FlowActionTelegramSendMessage
     *   |FlowActionTwilioMakeCall
     *   |FlowActionTwilioSendSms
     *   |FlowActionWhatsappSendMessage
     *   |FlowActionXmlParseXml
     *   |FlowActionXmlSerializeXml
     *   |FlowActionZapierTriggerWebhook
     * )> $actions
     */
    #[JsonProperty('actions'), ArrayType([new Union(FlowActionActivecampaignListContacts::class, FlowActionActivecampaignUpsertContact::class, FlowActionAirtableCreateRecord::class, FlowActionAirtableListRecords::class, FlowActionAirtableUpdateRecord::class, FlowActionAuth0CreateUser::class, FlowActionAuth0GetUser::class, FlowActionAuth0UpdateUser::class, FlowActionAuth0SendRequest::class, FlowActionAuth0SendEmail::class, FlowActionAuth0SendSms::class, FlowActionAuth0MakeCall::class, FlowActionBigqueryInsertRows::class, FlowActionClearbitFindPerson::class, FlowActionClearbitFindCompany::class, FlowActionEmailVerifyEmail::class, FlowActionFlowBooleanCondition::class, FlowActionFlowDelayFlow::class, FlowActionFlowDoNothing::class, FlowActionFlowErrorMessage::class, FlowActionFlowMapValue::class, FlowActionFlowReturnJson::class, FlowActionFlowStoreVars::class, FlowActionGoogleSheetsAddRow::class, FlowActionHttpSendRequest::class, FlowActionHubspotEnrollContact::class, FlowActionHubspotGetContact::class, FlowActionHubspotUpsertContact::class, FlowActionJsonCreateJson::class, FlowActionJsonParseJson::class, FlowActionJsonSerializeJson::class, FlowActionJwtDecodeJwt::class, FlowActionJwtSignJwt::class, FlowActionJwtVerifyJwt::class, FlowActionMailchimpUpsertMember::class, FlowActionMailjetSendEmail::class, FlowActionOtpGenerateCode::class, FlowActionOtpVerifyCode::class, FlowActionPipedriveAddDeal::class, FlowActionPipedriveAddOrganization::class, FlowActionPipedriveAddPerson::class, FlowActionSalesforceCreateLead::class, FlowActionSalesforceGetLead::class, FlowActionSalesforceSearchLeads::class, FlowActionSalesforceUpdateLead::class, FlowActionSendgridSendEmail::class, FlowActionSlackPostMessage::class, FlowActionStripeAddTaxId::class, FlowActionStripeCreateCustomer::class, FlowActionStripeCreatePortalSession::class, FlowActionStripeDeleteTaxId::class, FlowActionStripeFindCustomers::class, FlowActionStripeGetCustomer::class, FlowActionStripeUpdateCustomer::class, FlowActionTelegramSendMessage::class, FlowActionTwilioMakeCall::class, FlowActionTwilioSendSms::class, FlowActionWhatsappSendMessage::class, FlowActionXmlParseXml::class, FlowActionXmlSerializeXml::class, FlowActionZapierTriggerWebhook::class)])]
    private ?array $actions;

    /**
     * @var DateTime $createdAt
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @var ?string $executedAt
     */
    #[JsonProperty('executed_at')]
    private ?string $executedAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   actions?: ?array<(
     *    FlowActionActivecampaignListContacts
     *   |FlowActionActivecampaignUpsertContact
     *   |FlowActionAirtableCreateRecord
     *   |FlowActionAirtableListRecords
     *   |FlowActionAirtableUpdateRecord
     *   |FlowActionAuth0CreateUser
     *   |FlowActionAuth0GetUser
     *   |FlowActionAuth0UpdateUser
     *   |FlowActionAuth0SendRequest
     *   |FlowActionAuth0SendEmail
     *   |FlowActionAuth0SendSms
     *   |FlowActionAuth0MakeCall
     *   |FlowActionBigqueryInsertRows
     *   |FlowActionClearbitFindPerson
     *   |FlowActionClearbitFindCompany
     *   |FlowActionEmailVerifyEmail
     *   |FlowActionFlowBooleanCondition
     *   |FlowActionFlowDelayFlow
     *   |FlowActionFlowDoNothing
     *   |FlowActionFlowErrorMessage
     *   |FlowActionFlowMapValue
     *   |FlowActionFlowReturnJson
     *   |FlowActionFlowStoreVars
     *   |FlowActionGoogleSheetsAddRow
     *   |FlowActionHttpSendRequest
     *   |FlowActionHubspotEnrollContact
     *   |FlowActionHubspotGetContact
     *   |FlowActionHubspotUpsertContact
     *   |FlowActionJsonCreateJson
     *   |FlowActionJsonParseJson
     *   |FlowActionJsonSerializeJson
     *   |FlowActionJwtDecodeJwt
     *   |FlowActionJwtSignJwt
     *   |FlowActionJwtVerifyJwt
     *   |FlowActionMailchimpUpsertMember
     *   |FlowActionMailjetSendEmail
     *   |FlowActionOtpGenerateCode
     *   |FlowActionOtpVerifyCode
     *   |FlowActionPipedriveAddDeal
     *   |FlowActionPipedriveAddOrganization
     *   |FlowActionPipedriveAddPerson
     *   |FlowActionSalesforceCreateLead
     *   |FlowActionSalesforceGetLead
     *   |FlowActionSalesforceSearchLeads
     *   |FlowActionSalesforceUpdateLead
     *   |FlowActionSendgridSendEmail
     *   |FlowActionSlackPostMessage
     *   |FlowActionStripeAddTaxId
     *   |FlowActionStripeCreateCustomer
     *   |FlowActionStripeCreatePortalSession
     *   |FlowActionStripeDeleteTaxId
     *   |FlowActionStripeFindCustomers
     *   |FlowActionStripeGetCustomer
     *   |FlowActionStripeUpdateCustomer
     *   |FlowActionTelegramSendMessage
     *   |FlowActionTwilioMakeCall
     *   |FlowActionTwilioSendSms
     *   |FlowActionWhatsappSendMessage
     *   |FlowActionXmlParseXml
     *   |FlowActionXmlSerializeXml
     *   |FlowActionZapierTriggerWebhook
     * )>,
     *   executedAt?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->actions = $values['actions'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->executedAt = $values['executedAt'] ?? null;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?array<(
     *    FlowActionActivecampaignListContacts
     *   |FlowActionActivecampaignUpsertContact
     *   |FlowActionAirtableCreateRecord
     *   |FlowActionAirtableListRecords
     *   |FlowActionAirtableUpdateRecord
     *   |FlowActionAuth0CreateUser
     *   |FlowActionAuth0GetUser
     *   |FlowActionAuth0UpdateUser
     *   |FlowActionAuth0SendRequest
     *   |FlowActionAuth0SendEmail
     *   |FlowActionAuth0SendSms
     *   |FlowActionAuth0MakeCall
     *   |FlowActionBigqueryInsertRows
     *   |FlowActionClearbitFindPerson
     *   |FlowActionClearbitFindCompany
     *   |FlowActionEmailVerifyEmail
     *   |FlowActionFlowBooleanCondition
     *   |FlowActionFlowDelayFlow
     *   |FlowActionFlowDoNothing
     *   |FlowActionFlowErrorMessage
     *   |FlowActionFlowMapValue
     *   |FlowActionFlowReturnJson
     *   |FlowActionFlowStoreVars
     *   |FlowActionGoogleSheetsAddRow
     *   |FlowActionHttpSendRequest
     *   |FlowActionHubspotEnrollContact
     *   |FlowActionHubspotGetContact
     *   |FlowActionHubspotUpsertContact
     *   |FlowActionJsonCreateJson
     *   |FlowActionJsonParseJson
     *   |FlowActionJsonSerializeJson
     *   |FlowActionJwtDecodeJwt
     *   |FlowActionJwtSignJwt
     *   |FlowActionJwtVerifyJwt
     *   |FlowActionMailchimpUpsertMember
     *   |FlowActionMailjetSendEmail
     *   |FlowActionOtpGenerateCode
     *   |FlowActionOtpVerifyCode
     *   |FlowActionPipedriveAddDeal
     *   |FlowActionPipedriveAddOrganization
     *   |FlowActionPipedriveAddPerson
     *   |FlowActionSalesforceCreateLead
     *   |FlowActionSalesforceGetLead
     *   |FlowActionSalesforceSearchLeads
     *   |FlowActionSalesforceUpdateLead
     *   |FlowActionSendgridSendEmail
     *   |FlowActionSlackPostMessage
     *   |FlowActionStripeAddTaxId
     *   |FlowActionStripeCreateCustomer
     *   |FlowActionStripeCreatePortalSession
     *   |FlowActionStripeDeleteTaxId
     *   |FlowActionStripeFindCustomers
     *   |FlowActionStripeGetCustomer
     *   |FlowActionStripeUpdateCustomer
     *   |FlowActionTelegramSendMessage
     *   |FlowActionTwilioMakeCall
     *   |FlowActionTwilioSendSms
     *   |FlowActionWhatsappSendMessage
     *   |FlowActionXmlParseXml
     *   |FlowActionXmlSerializeXml
     *   |FlowActionZapierTriggerWebhook
     * )>
     */
    public function getActions(): ?array
    {
        return $this->actions;
    }

    /**
     * @param ?array<(
     *    FlowActionActivecampaignListContacts
     *   |FlowActionActivecampaignUpsertContact
     *   |FlowActionAirtableCreateRecord
     *   |FlowActionAirtableListRecords
     *   |FlowActionAirtableUpdateRecord
     *   |FlowActionAuth0CreateUser
     *   |FlowActionAuth0GetUser
     *   |FlowActionAuth0UpdateUser
     *   |FlowActionAuth0SendRequest
     *   |FlowActionAuth0SendEmail
     *   |FlowActionAuth0SendSms
     *   |FlowActionAuth0MakeCall
     *   |FlowActionBigqueryInsertRows
     *   |FlowActionClearbitFindPerson
     *   |FlowActionClearbitFindCompany
     *   |FlowActionEmailVerifyEmail
     *   |FlowActionFlowBooleanCondition
     *   |FlowActionFlowDelayFlow
     *   |FlowActionFlowDoNothing
     *   |FlowActionFlowErrorMessage
     *   |FlowActionFlowMapValue
     *   |FlowActionFlowReturnJson
     *   |FlowActionFlowStoreVars
     *   |FlowActionGoogleSheetsAddRow
     *   |FlowActionHttpSendRequest
     *   |FlowActionHubspotEnrollContact
     *   |FlowActionHubspotGetContact
     *   |FlowActionHubspotUpsertContact
     *   |FlowActionJsonCreateJson
     *   |FlowActionJsonParseJson
     *   |FlowActionJsonSerializeJson
     *   |FlowActionJwtDecodeJwt
     *   |FlowActionJwtSignJwt
     *   |FlowActionJwtVerifyJwt
     *   |FlowActionMailchimpUpsertMember
     *   |FlowActionMailjetSendEmail
     *   |FlowActionOtpGenerateCode
     *   |FlowActionOtpVerifyCode
     *   |FlowActionPipedriveAddDeal
     *   |FlowActionPipedriveAddOrganization
     *   |FlowActionPipedriveAddPerson
     *   |FlowActionSalesforceCreateLead
     *   |FlowActionSalesforceGetLead
     *   |FlowActionSalesforceSearchLeads
     *   |FlowActionSalesforceUpdateLead
     *   |FlowActionSendgridSendEmail
     *   |FlowActionSlackPostMessage
     *   |FlowActionStripeAddTaxId
     *   |FlowActionStripeCreateCustomer
     *   |FlowActionStripeCreatePortalSession
     *   |FlowActionStripeDeleteTaxId
     *   |FlowActionStripeFindCustomers
     *   |FlowActionStripeGetCustomer
     *   |FlowActionStripeUpdateCustomer
     *   |FlowActionTelegramSendMessage
     *   |FlowActionTwilioMakeCall
     *   |FlowActionTwilioSendSms
     *   |FlowActionWhatsappSendMessage
     *   |FlowActionXmlParseXml
     *   |FlowActionXmlSerializeXml
     *   |FlowActionZapierTriggerWebhook
     * )> $value
     */
    public function setActions(?array $value = null): self
    {
        $this->actions = $value;
        $this->_setField('actions');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExecutedAt(): ?string
    {
        return $this->executedAt;
    }

    /**
     * @param ?string $value
     */
    public function setExecutedAt(?string $value = null): self
    {
        $this->executedAt = $value;
        $this->_setField('executedAt');
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
