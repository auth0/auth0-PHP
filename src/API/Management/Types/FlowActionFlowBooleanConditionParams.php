<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class FlowActionFlowBooleanConditionParams extends JsonSerializableType
{
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
     * )> $then
     */
    #[JsonProperty('then'), ArrayType([new Union(FlowActionActivecampaignListContacts::class, FlowActionActivecampaignUpsertContact::class, FlowActionAirtableCreateRecord::class, FlowActionAirtableListRecords::class, FlowActionAirtableUpdateRecord::class, FlowActionAuth0CreateUser::class, FlowActionAuth0GetUser::class, FlowActionAuth0UpdateUser::class, FlowActionAuth0SendRequest::class, FlowActionAuth0SendEmail::class, FlowActionAuth0SendSms::class, FlowActionAuth0MakeCall::class, FlowActionBigqueryInsertRows::class, FlowActionClearbitFindPerson::class, FlowActionClearbitFindCompany::class, FlowActionEmailVerifyEmail::class, FlowActionFlowBooleanCondition::class, FlowActionFlowDelayFlow::class, FlowActionFlowDoNothing::class, FlowActionFlowErrorMessage::class, FlowActionFlowMapValue::class, FlowActionFlowReturnJson::class, FlowActionFlowStoreVars::class, FlowActionGoogleSheetsAddRow::class, FlowActionHttpSendRequest::class, FlowActionHubspotEnrollContact::class, FlowActionHubspotGetContact::class, FlowActionHubspotUpsertContact::class, FlowActionJsonCreateJson::class, FlowActionJsonParseJson::class, FlowActionJsonSerializeJson::class, FlowActionJwtDecodeJwt::class, FlowActionJwtSignJwt::class, FlowActionJwtVerifyJwt::class, FlowActionMailchimpUpsertMember::class, FlowActionMailjetSendEmail::class, FlowActionOtpGenerateCode::class, FlowActionOtpVerifyCode::class, FlowActionPipedriveAddDeal::class, FlowActionPipedriveAddOrganization::class, FlowActionPipedriveAddPerson::class, FlowActionSalesforceCreateLead::class, FlowActionSalesforceGetLead::class, FlowActionSalesforceSearchLeads::class, FlowActionSalesforceUpdateLead::class, FlowActionSendgridSendEmail::class, FlowActionSlackPostMessage::class, FlowActionStripeAddTaxId::class, FlowActionStripeCreateCustomer::class, FlowActionStripeCreatePortalSession::class, FlowActionStripeDeleteTaxId::class, FlowActionStripeFindCustomers::class, FlowActionStripeGetCustomer::class, FlowActionStripeUpdateCustomer::class, FlowActionTelegramSendMessage::class, FlowActionTwilioMakeCall::class, FlowActionTwilioSendSms::class, FlowActionWhatsappSendMessage::class, FlowActionXmlParseXml::class, FlowActionXmlSerializeXml::class, FlowActionZapierTriggerWebhook::class)])]
    private ?array $then;

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
     * )> $else
     */
    #[JsonProperty('else'), ArrayType([new Union(FlowActionActivecampaignListContacts::class, FlowActionActivecampaignUpsertContact::class, FlowActionAirtableCreateRecord::class, FlowActionAirtableListRecords::class, FlowActionAirtableUpdateRecord::class, FlowActionAuth0CreateUser::class, FlowActionAuth0GetUser::class, FlowActionAuth0UpdateUser::class, FlowActionAuth0SendRequest::class, FlowActionAuth0SendEmail::class, FlowActionAuth0SendSms::class, FlowActionAuth0MakeCall::class, FlowActionBigqueryInsertRows::class, FlowActionClearbitFindPerson::class, FlowActionClearbitFindCompany::class, FlowActionEmailVerifyEmail::class, FlowActionFlowBooleanCondition::class, FlowActionFlowDelayFlow::class, FlowActionFlowDoNothing::class, FlowActionFlowErrorMessage::class, FlowActionFlowMapValue::class, FlowActionFlowReturnJson::class, FlowActionFlowStoreVars::class, FlowActionGoogleSheetsAddRow::class, FlowActionHttpSendRequest::class, FlowActionHubspotEnrollContact::class, FlowActionHubspotGetContact::class, FlowActionHubspotUpsertContact::class, FlowActionJsonCreateJson::class, FlowActionJsonParseJson::class, FlowActionJsonSerializeJson::class, FlowActionJwtDecodeJwt::class, FlowActionJwtSignJwt::class, FlowActionJwtVerifyJwt::class, FlowActionMailchimpUpsertMember::class, FlowActionMailjetSendEmail::class, FlowActionOtpGenerateCode::class, FlowActionOtpVerifyCode::class, FlowActionPipedriveAddDeal::class, FlowActionPipedriveAddOrganization::class, FlowActionPipedriveAddPerson::class, FlowActionSalesforceCreateLead::class, FlowActionSalesforceGetLead::class, FlowActionSalesforceSearchLeads::class, FlowActionSalesforceUpdateLead::class, FlowActionSendgridSendEmail::class, FlowActionSlackPostMessage::class, FlowActionStripeAddTaxId::class, FlowActionStripeCreateCustomer::class, FlowActionStripeCreatePortalSession::class, FlowActionStripeDeleteTaxId::class, FlowActionStripeFindCustomers::class, FlowActionStripeGetCustomer::class, FlowActionStripeUpdateCustomer::class, FlowActionTelegramSendMessage::class, FlowActionTwilioMakeCall::class, FlowActionTwilioSendSms::class, FlowActionWhatsappSendMessage::class, FlowActionXmlParseXml::class, FlowActionXmlSerializeXml::class, FlowActionZapierTriggerWebhook::class)])]
    private ?array $else;

    /**
     * @param array{
     *   then?: ?array<(
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
     *   else?: ?array<(
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
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->then = $values['then'] ?? null;
        $this->else = $values['else'] ?? null;
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
    public function getThen(): ?array
    {
        return $this->then;
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
    public function setThen(?array $value = null): self
    {
        $this->then = $value;
        $this->_setField('then');
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
    public function getElse(): ?array
    {
        return $this->else;
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
    public function setElse(?array $value = null): self
    {
        $this->else = $value;
        $this->_setField('else');
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
