<?php

namespace Auth0\SDK\API\Management\Flows\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\FlowActionActivecampaignListContacts;
use Auth0\SDK\API\Management\Types\FlowActionActivecampaignUpsertContact;
use Auth0\SDK\API\Management\Types\FlowActionAirtableCreateRecord;
use Auth0\SDK\API\Management\Types\FlowActionAirtableListRecords;
use Auth0\SDK\API\Management\Types\FlowActionAirtableUpdateRecord;
use Auth0\SDK\API\Management\Types\FlowActionAuth0CreateUser;
use Auth0\SDK\API\Management\Types\FlowActionAuth0GetUser;
use Auth0\SDK\API\Management\Types\FlowActionAuth0UpdateUser;
use Auth0\SDK\API\Management\Types\FlowActionAuth0SendRequest;
use Auth0\SDK\API\Management\Types\FlowActionAuth0SendEmail;
use Auth0\SDK\API\Management\Types\FlowActionAuth0SendSms;
use Auth0\SDK\API\Management\Types\FlowActionAuth0MakeCall;
use Auth0\SDK\API\Management\Types\FlowActionBigqueryInsertRows;
use Auth0\SDK\API\Management\Types\FlowActionClearbitFindPerson;
use Auth0\SDK\API\Management\Types\FlowActionClearbitFindCompany;
use Auth0\SDK\API\Management\Types\FlowActionEmailVerifyEmail;
use Auth0\SDK\API\Management\Types\FlowActionFlowBooleanCondition;
use Auth0\SDK\API\Management\Types\FlowActionFlowDelayFlow;
use Auth0\SDK\API\Management\Types\FlowActionFlowDoNothing;
use Auth0\SDK\API\Management\Types\FlowActionFlowErrorMessage;
use Auth0\SDK\API\Management\Types\FlowActionFlowMapValue;
use Auth0\SDK\API\Management\Types\FlowActionFlowReturnJson;
use Auth0\SDK\API\Management\Types\FlowActionFlowStoreVars;
use Auth0\SDK\API\Management\Types\FlowActionGoogleSheetsAddRow;
use Auth0\SDK\API\Management\Types\FlowActionHttpSendRequest;
use Auth0\SDK\API\Management\Types\FlowActionHubspotEnrollContact;
use Auth0\SDK\API\Management\Types\FlowActionHubspotGetContact;
use Auth0\SDK\API\Management\Types\FlowActionHubspotUpsertContact;
use Auth0\SDK\API\Management\Types\FlowActionJsonCreateJson;
use Auth0\SDK\API\Management\Types\FlowActionJsonParseJson;
use Auth0\SDK\API\Management\Types\FlowActionJsonSerializeJson;
use Auth0\SDK\API\Management\Types\FlowActionJwtDecodeJwt;
use Auth0\SDK\API\Management\Types\FlowActionJwtSignJwt;
use Auth0\SDK\API\Management\Types\FlowActionJwtVerifyJwt;
use Auth0\SDK\API\Management\Types\FlowActionMailchimpUpsertMember;
use Auth0\SDK\API\Management\Types\FlowActionMailjetSendEmail;
use Auth0\SDK\API\Management\Types\FlowActionOtpGenerateCode;
use Auth0\SDK\API\Management\Types\FlowActionOtpVerifyCode;
use Auth0\SDK\API\Management\Types\FlowActionPipedriveAddDeal;
use Auth0\SDK\API\Management\Types\FlowActionPipedriveAddOrganization;
use Auth0\SDK\API\Management\Types\FlowActionPipedriveAddPerson;
use Auth0\SDK\API\Management\Types\FlowActionSalesforceCreateLead;
use Auth0\SDK\API\Management\Types\FlowActionSalesforceGetLead;
use Auth0\SDK\API\Management\Types\FlowActionSalesforceSearchLeads;
use Auth0\SDK\API\Management\Types\FlowActionSalesforceUpdateLead;
use Auth0\SDK\API\Management\Types\FlowActionSendgridSendEmail;
use Auth0\SDK\API\Management\Types\FlowActionSlackPostMessage;
use Auth0\SDK\API\Management\Types\FlowActionStripeAddTaxId;
use Auth0\SDK\API\Management\Types\FlowActionStripeCreateCustomer;
use Auth0\SDK\API\Management\Types\FlowActionStripeCreatePortalSession;
use Auth0\SDK\API\Management\Types\FlowActionStripeDeleteTaxId;
use Auth0\SDK\API\Management\Types\FlowActionStripeFindCustomers;
use Auth0\SDK\API\Management\Types\FlowActionStripeGetCustomer;
use Auth0\SDK\API\Management\Types\FlowActionStripeUpdateCustomer;
use Auth0\SDK\API\Management\Types\FlowActionTelegramSendMessage;
use Auth0\SDK\API\Management\Types\FlowActionTwilioMakeCall;
use Auth0\SDK\API\Management\Types\FlowActionTwilioSendSms;
use Auth0\SDK\API\Management\Types\FlowActionWhatsappSendMessage;
use Auth0\SDK\API\Management\Types\FlowActionXmlParseXml;
use Auth0\SDK\API\Management\Types\FlowActionXmlSerializeXml;
use Auth0\SDK\API\Management\Types\FlowActionZapierTriggerWebhook;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class UpdateFlowRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $name
     */
    #[JsonProperty('name')]
    private ?string $name;

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
     * @param array{
     *   name?: ?string,
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
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->actions = $values['actions'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
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
}
