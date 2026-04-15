<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Addons enabled for this client and their associated configurations.
 */
class ClientAddons extends JsonSerializableType
{
    /**
     * @var ?ClientAddonAws $aws
     */
    #[JsonProperty('aws')]
    private ?ClientAddonAws $aws;

    /**
     * @var ?ClientAddonAzureBlob $azureBlob
     */
    #[JsonProperty('azure_blob')]
    private ?ClientAddonAzureBlob $azureBlob;

    /**
     * @var ?ClientAddonAzureSb $azureSb
     */
    #[JsonProperty('azure_sb')]
    private ?ClientAddonAzureSb $azureSb;

    /**
     * @var ?ClientAddonRms $rms
     */
    #[JsonProperty('rms')]
    private ?ClientAddonRms $rms;

    /**
     * @var ?ClientAddonMscrm $mscrm
     */
    #[JsonProperty('mscrm')]
    private ?ClientAddonMscrm $mscrm;

    /**
     * @var ?ClientAddonSlack $slack
     */
    #[JsonProperty('slack')]
    private ?ClientAddonSlack $slack;

    /**
     * @var ?ClientAddonSentry $sentry
     */
    #[JsonProperty('sentry')]
    private ?ClientAddonSentry $sentry;

    /**
     * @var ?array<string, mixed> $box
     */
    #[JsonProperty('box'), ArrayType(['string' => 'mixed'])]
    private ?array $box;

    /**
     * @var ?array<string, mixed> $cloudbees
     */
    #[JsonProperty('cloudbees'), ArrayType(['string' => 'mixed'])]
    private ?array $cloudbees;

    /**
     * @var ?array<string, mixed> $concur
     */
    #[JsonProperty('concur'), ArrayType(['string' => 'mixed'])]
    private ?array $concur;

    /**
     * @var ?array<string, mixed> $dropbox
     */
    #[JsonProperty('dropbox'), ArrayType(['string' => 'mixed'])]
    private ?array $dropbox;

    /**
     * @var ?ClientAddonEchoSign $echosign
     */
    #[JsonProperty('echosign')]
    private ?ClientAddonEchoSign $echosign;

    /**
     * @var ?ClientAddonEgnyte $egnyte
     */
    #[JsonProperty('egnyte')]
    private ?ClientAddonEgnyte $egnyte;

    /**
     * @var ?ClientAddonFirebase $firebase
     */
    #[JsonProperty('firebase')]
    private ?ClientAddonFirebase $firebase;

    /**
     * @var ?ClientAddonNewRelic $newrelic
     */
    #[JsonProperty('newrelic')]
    private ?ClientAddonNewRelic $newrelic;

    /**
     * @var ?ClientAddonOffice365 $office365
     */
    #[JsonProperty('office365')]
    private ?ClientAddonOffice365 $office365;

    /**
     * @var ?ClientAddonSalesforce $salesforce
     */
    #[JsonProperty('salesforce')]
    private ?ClientAddonSalesforce $salesforce;

    /**
     * @var ?ClientAddonSalesforceApi $salesforceApi
     */
    #[JsonProperty('salesforce_api')]
    private ?ClientAddonSalesforceApi $salesforceApi;

    /**
     * @var ?ClientAddonSalesforceSandboxApi $salesforceSandboxApi
     */
    #[JsonProperty('salesforce_sandbox_api')]
    private ?ClientAddonSalesforceSandboxApi $salesforceSandboxApi;

    /**
     * @var ?ClientAddonSaml $samlp
     */
    #[JsonProperty('samlp')]
    private ?ClientAddonSaml $samlp;

    /**
     * @var ?ClientAddonLayer $layer
     */
    #[JsonProperty('layer')]
    private ?ClientAddonLayer $layer;

    /**
     * @var ?ClientAddonSapapi $sapApi
     */
    #[JsonProperty('sap_api')]
    private ?ClientAddonSapapi $sapApi;

    /**
     * @var ?ClientAddonSharePoint $sharepoint
     */
    #[JsonProperty('sharepoint')]
    private ?ClientAddonSharePoint $sharepoint;

    /**
     * @var ?ClientAddonSpringCm $springcm
     */
    #[JsonProperty('springcm')]
    private ?ClientAddonSpringCm $springcm;

    /**
     * @var ?ClientAddonWams $wams
     */
    #[JsonProperty('wams')]
    private ?ClientAddonWams $wams;

    /**
     * @var ?array<string, mixed> $wsfed
     */
    #[JsonProperty('wsfed'), ArrayType(['string' => 'mixed'])]
    private ?array $wsfed;

    /**
     * @var ?ClientAddonZendesk $zendesk
     */
    #[JsonProperty('zendesk')]
    private ?ClientAddonZendesk $zendesk;

    /**
     * @var ?ClientAddonZoom $zoom
     */
    #[JsonProperty('zoom')]
    private ?ClientAddonZoom $zoom;

    /**
     * @var ?ClientAddonSsoIntegration $ssoIntegration
     */
    #[JsonProperty('sso_integration')]
    private ?ClientAddonSsoIntegration $ssoIntegration;

    /**
     * @var ?ClientAddonOag $oag
     */
    #[JsonProperty('oag')]
    private ?ClientAddonOag $oag;

    /**
     * @param array{
     *   aws?: ?ClientAddonAws,
     *   azureBlob?: ?ClientAddonAzureBlob,
     *   azureSb?: ?ClientAddonAzureSb,
     *   rms?: ?ClientAddonRms,
     *   mscrm?: ?ClientAddonMscrm,
     *   slack?: ?ClientAddonSlack,
     *   sentry?: ?ClientAddonSentry,
     *   box?: ?array<string, mixed>,
     *   cloudbees?: ?array<string, mixed>,
     *   concur?: ?array<string, mixed>,
     *   dropbox?: ?array<string, mixed>,
     *   echosign?: ?ClientAddonEchoSign,
     *   egnyte?: ?ClientAddonEgnyte,
     *   firebase?: ?ClientAddonFirebase,
     *   newrelic?: ?ClientAddonNewRelic,
     *   office365?: ?ClientAddonOffice365,
     *   salesforce?: ?ClientAddonSalesforce,
     *   salesforceApi?: ?ClientAddonSalesforceApi,
     *   salesforceSandboxApi?: ?ClientAddonSalesforceSandboxApi,
     *   samlp?: ?ClientAddonSaml,
     *   layer?: ?ClientAddonLayer,
     *   sapApi?: ?ClientAddonSapapi,
     *   sharepoint?: ?ClientAddonSharePoint,
     *   springcm?: ?ClientAddonSpringCm,
     *   wams?: ?ClientAddonWams,
     *   wsfed?: ?array<string, mixed>,
     *   zendesk?: ?ClientAddonZendesk,
     *   zoom?: ?ClientAddonZoom,
     *   ssoIntegration?: ?ClientAddonSsoIntegration,
     *   oag?: ?ClientAddonOag,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->aws = $values['aws'] ?? null;
        $this->azureBlob = $values['azureBlob'] ?? null;
        $this->azureSb = $values['azureSb'] ?? null;
        $this->rms = $values['rms'] ?? null;
        $this->mscrm = $values['mscrm'] ?? null;
        $this->slack = $values['slack'] ?? null;
        $this->sentry = $values['sentry'] ?? null;
        $this->box = $values['box'] ?? null;
        $this->cloudbees = $values['cloudbees'] ?? null;
        $this->concur = $values['concur'] ?? null;
        $this->dropbox = $values['dropbox'] ?? null;
        $this->echosign = $values['echosign'] ?? null;
        $this->egnyte = $values['egnyte'] ?? null;
        $this->firebase = $values['firebase'] ?? null;
        $this->newrelic = $values['newrelic'] ?? null;
        $this->office365 = $values['office365'] ?? null;
        $this->salesforce = $values['salesforce'] ?? null;
        $this->salesforceApi = $values['salesforceApi'] ?? null;
        $this->salesforceSandboxApi = $values['salesforceSandboxApi'] ?? null;
        $this->samlp = $values['samlp'] ?? null;
        $this->layer = $values['layer'] ?? null;
        $this->sapApi = $values['sapApi'] ?? null;
        $this->sharepoint = $values['sharepoint'] ?? null;
        $this->springcm = $values['springcm'] ?? null;
        $this->wams = $values['wams'] ?? null;
        $this->wsfed = $values['wsfed'] ?? null;
        $this->zendesk = $values['zendesk'] ?? null;
        $this->zoom = $values['zoom'] ?? null;
        $this->ssoIntegration = $values['ssoIntegration'] ?? null;
        $this->oag = $values['oag'] ?? null;
    }

    /**
     * @return ?ClientAddonAws
     */
    public function getAws(): ?ClientAddonAws
    {
        return $this->aws;
    }

    /**
     * @param ?ClientAddonAws $value
     */
    public function setAws(?ClientAddonAws $value = null): self
    {
        $this->aws = $value;
        $this->_setField('aws');
        return $this;
    }

    /**
     * @return ?ClientAddonAzureBlob
     */
    public function getAzureBlob(): ?ClientAddonAzureBlob
    {
        return $this->azureBlob;
    }

    /**
     * @param ?ClientAddonAzureBlob $value
     */
    public function setAzureBlob(?ClientAddonAzureBlob $value = null): self
    {
        $this->azureBlob = $value;
        $this->_setField('azureBlob');
        return $this;
    }

    /**
     * @return ?ClientAddonAzureSb
     */
    public function getAzureSb(): ?ClientAddonAzureSb
    {
        return $this->azureSb;
    }

    /**
     * @param ?ClientAddonAzureSb $value
     */
    public function setAzureSb(?ClientAddonAzureSb $value = null): self
    {
        $this->azureSb = $value;
        $this->_setField('azureSb');
        return $this;
    }

    /**
     * @return ?ClientAddonRms
     */
    public function getRms(): ?ClientAddonRms
    {
        return $this->rms;
    }

    /**
     * @param ?ClientAddonRms $value
     */
    public function setRms(?ClientAddonRms $value = null): self
    {
        $this->rms = $value;
        $this->_setField('rms');
        return $this;
    }

    /**
     * @return ?ClientAddonMscrm
     */
    public function getMscrm(): ?ClientAddonMscrm
    {
        return $this->mscrm;
    }

    /**
     * @param ?ClientAddonMscrm $value
     */
    public function setMscrm(?ClientAddonMscrm $value = null): self
    {
        $this->mscrm = $value;
        $this->_setField('mscrm');
        return $this;
    }

    /**
     * @return ?ClientAddonSlack
     */
    public function getSlack(): ?ClientAddonSlack
    {
        return $this->slack;
    }

    /**
     * @param ?ClientAddonSlack $value
     */
    public function setSlack(?ClientAddonSlack $value = null): self
    {
        $this->slack = $value;
        $this->_setField('slack');
        return $this;
    }

    /**
     * @return ?ClientAddonSentry
     */
    public function getSentry(): ?ClientAddonSentry
    {
        return $this->sentry;
    }

    /**
     * @param ?ClientAddonSentry $value
     */
    public function setSentry(?ClientAddonSentry $value = null): self
    {
        $this->sentry = $value;
        $this->_setField('sentry');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getBox(): ?array
    {
        return $this->box;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setBox(?array $value = null): self
    {
        $this->box = $value;
        $this->_setField('box');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getCloudbees(): ?array
    {
        return $this->cloudbees;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setCloudbees(?array $value = null): self
    {
        $this->cloudbees = $value;
        $this->_setField('cloudbees');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getConcur(): ?array
    {
        return $this->concur;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setConcur(?array $value = null): self
    {
        $this->concur = $value;
        $this->_setField('concur');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getDropbox(): ?array
    {
        return $this->dropbox;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setDropbox(?array $value = null): self
    {
        $this->dropbox = $value;
        $this->_setField('dropbox');
        return $this;
    }

    /**
     * @return ?ClientAddonEchoSign
     */
    public function getEchosign(): ?ClientAddonEchoSign
    {
        return $this->echosign;
    }

    /**
     * @param ?ClientAddonEchoSign $value
     */
    public function setEchosign(?ClientAddonEchoSign $value = null): self
    {
        $this->echosign = $value;
        $this->_setField('echosign');
        return $this;
    }

    /**
     * @return ?ClientAddonEgnyte
     */
    public function getEgnyte(): ?ClientAddonEgnyte
    {
        return $this->egnyte;
    }

    /**
     * @param ?ClientAddonEgnyte $value
     */
    public function setEgnyte(?ClientAddonEgnyte $value = null): self
    {
        $this->egnyte = $value;
        $this->_setField('egnyte');
        return $this;
    }

    /**
     * @return ?ClientAddonFirebase
     */
    public function getFirebase(): ?ClientAddonFirebase
    {
        return $this->firebase;
    }

    /**
     * @param ?ClientAddonFirebase $value
     */
    public function setFirebase(?ClientAddonFirebase $value = null): self
    {
        $this->firebase = $value;
        $this->_setField('firebase');
        return $this;
    }

    /**
     * @return ?ClientAddonNewRelic
     */
    public function getNewrelic(): ?ClientAddonNewRelic
    {
        return $this->newrelic;
    }

    /**
     * @param ?ClientAddonNewRelic $value
     */
    public function setNewrelic(?ClientAddonNewRelic $value = null): self
    {
        $this->newrelic = $value;
        $this->_setField('newrelic');
        return $this;
    }

    /**
     * @return ?ClientAddonOffice365
     */
    public function getOffice365(): ?ClientAddonOffice365
    {
        return $this->office365;
    }

    /**
     * @param ?ClientAddonOffice365 $value
     */
    public function setOffice365(?ClientAddonOffice365 $value = null): self
    {
        $this->office365 = $value;
        $this->_setField('office365');
        return $this;
    }

    /**
     * @return ?ClientAddonSalesforce
     */
    public function getSalesforce(): ?ClientAddonSalesforce
    {
        return $this->salesforce;
    }

    /**
     * @param ?ClientAddonSalesforce $value
     */
    public function setSalesforce(?ClientAddonSalesforce $value = null): self
    {
        $this->salesforce = $value;
        $this->_setField('salesforce');
        return $this;
    }

    /**
     * @return ?ClientAddonSalesforceApi
     */
    public function getSalesforceApi(): ?ClientAddonSalesforceApi
    {
        return $this->salesforceApi;
    }

    /**
     * @param ?ClientAddonSalesforceApi $value
     */
    public function setSalesforceApi(?ClientAddonSalesforceApi $value = null): self
    {
        $this->salesforceApi = $value;
        $this->_setField('salesforceApi');
        return $this;
    }

    /**
     * @return ?ClientAddonSalesforceSandboxApi
     */
    public function getSalesforceSandboxApi(): ?ClientAddonSalesforceSandboxApi
    {
        return $this->salesforceSandboxApi;
    }

    /**
     * @param ?ClientAddonSalesforceSandboxApi $value
     */
    public function setSalesforceSandboxApi(?ClientAddonSalesforceSandboxApi $value = null): self
    {
        $this->salesforceSandboxApi = $value;
        $this->_setField('salesforceSandboxApi');
        return $this;
    }

    /**
     * @return ?ClientAddonSaml
     */
    public function getSamlp(): ?ClientAddonSaml
    {
        return $this->samlp;
    }

    /**
     * @param ?ClientAddonSaml $value
     */
    public function setSamlp(?ClientAddonSaml $value = null): self
    {
        $this->samlp = $value;
        $this->_setField('samlp');
        return $this;
    }

    /**
     * @return ?ClientAddonLayer
     */
    public function getLayer(): ?ClientAddonLayer
    {
        return $this->layer;
    }

    /**
     * @param ?ClientAddonLayer $value
     */
    public function setLayer(?ClientAddonLayer $value = null): self
    {
        $this->layer = $value;
        $this->_setField('layer');
        return $this;
    }

    /**
     * @return ?ClientAddonSapapi
     */
    public function getSapApi(): ?ClientAddonSapapi
    {
        return $this->sapApi;
    }

    /**
     * @param ?ClientAddonSapapi $value
     */
    public function setSapApi(?ClientAddonSapapi $value = null): self
    {
        $this->sapApi = $value;
        $this->_setField('sapApi');
        return $this;
    }

    /**
     * @return ?ClientAddonSharePoint
     */
    public function getSharepoint(): ?ClientAddonSharePoint
    {
        return $this->sharepoint;
    }

    /**
     * @param ?ClientAddonSharePoint $value
     */
    public function setSharepoint(?ClientAddonSharePoint $value = null): self
    {
        $this->sharepoint = $value;
        $this->_setField('sharepoint');
        return $this;
    }

    /**
     * @return ?ClientAddonSpringCm
     */
    public function getSpringcm(): ?ClientAddonSpringCm
    {
        return $this->springcm;
    }

    /**
     * @param ?ClientAddonSpringCm $value
     */
    public function setSpringcm(?ClientAddonSpringCm $value = null): self
    {
        $this->springcm = $value;
        $this->_setField('springcm');
        return $this;
    }

    /**
     * @return ?ClientAddonWams
     */
    public function getWams(): ?ClientAddonWams
    {
        return $this->wams;
    }

    /**
     * @param ?ClientAddonWams $value
     */
    public function setWams(?ClientAddonWams $value = null): self
    {
        $this->wams = $value;
        $this->_setField('wams');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getWsfed(): ?array
    {
        return $this->wsfed;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setWsfed(?array $value = null): self
    {
        $this->wsfed = $value;
        $this->_setField('wsfed');
        return $this;
    }

    /**
     * @return ?ClientAddonZendesk
     */
    public function getZendesk(): ?ClientAddonZendesk
    {
        return $this->zendesk;
    }

    /**
     * @param ?ClientAddonZendesk $value
     */
    public function setZendesk(?ClientAddonZendesk $value = null): self
    {
        $this->zendesk = $value;
        $this->_setField('zendesk');
        return $this;
    }

    /**
     * @return ?ClientAddonZoom
     */
    public function getZoom(): ?ClientAddonZoom
    {
        return $this->zoom;
    }

    /**
     * @param ?ClientAddonZoom $value
     */
    public function setZoom(?ClientAddonZoom $value = null): self
    {
        $this->zoom = $value;
        $this->_setField('zoom');
        return $this;
    }

    /**
     * @return ?ClientAddonSsoIntegration
     */
    public function getSsoIntegration(): ?ClientAddonSsoIntegration
    {
        return $this->ssoIntegration;
    }

    /**
     * @param ?ClientAddonSsoIntegration $value
     */
    public function setSsoIntegration(?ClientAddonSsoIntegration $value = null): self
    {
        $this->ssoIntegration = $value;
        $this->_setField('ssoIntegration');
        return $this;
    }

    /**
     * @return ?ClientAddonOag
     */
    public function getOag(): ?ClientAddonOag
    {
        return $this->oag;
    }

    /**
     * @param ?ClientAddonOag $value
     */
    public function setOag(?ClientAddonOag $value = null): self
    {
        $this->oag = $value;
        $this->_setField('oag');
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
