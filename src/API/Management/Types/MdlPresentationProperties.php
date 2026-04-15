<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class MdlPresentationProperties extends JsonSerializableType
{
    /**
     * @var ?bool $familyName Family Name
     */
    #[JsonProperty('family_name')]
    private ?bool $familyName;

    /**
     * @var ?bool $givenName Given Name
     */
    #[JsonProperty('given_name')]
    private ?bool $givenName;

    /**
     * @var ?bool $birthDate Birth Date
     */
    #[JsonProperty('birth_date')]
    private ?bool $birthDate;

    /**
     * @var ?bool $issueDate Issue Date
     */
    #[JsonProperty('issue_date')]
    private ?bool $issueDate;

    /**
     * @var ?bool $expiryDate Expiry Date
     */
    #[JsonProperty('expiry_date')]
    private ?bool $expiryDate;

    /**
     * @var ?bool $issuingCountry Issuing Country
     */
    #[JsonProperty('issuing_country')]
    private ?bool $issuingCountry;

    /**
     * @var ?bool $issuingAuthority Issuing Authority
     */
    #[JsonProperty('issuing_authority')]
    private ?bool $issuingAuthority;

    /**
     * @var ?bool $portrait Portrait
     */
    #[JsonProperty('portrait')]
    private ?bool $portrait;

    /**
     * @var ?bool $drivingPrivileges Driving Privileges
     */
    #[JsonProperty('driving_privileges')]
    private ?bool $drivingPrivileges;

    /**
     * @var ?bool $residentAddress Resident Address
     */
    #[JsonProperty('resident_address')]
    private ?bool $residentAddress;

    /**
     * @var ?bool $portraitCaptureDate Portrait Capture Date
     */
    #[JsonProperty('portrait_capture_date')]
    private ?bool $portraitCaptureDate;

    /**
     * @var ?bool $ageInYears Age in Years
     */
    #[JsonProperty('age_in_years')]
    private ?bool $ageInYears;

    /**
     * @var ?bool $ageBirthYear Age Birth Year
     */
    #[JsonProperty('age_birth_year')]
    private ?bool $ageBirthYear;

    /**
     * @var ?bool $issuingJurisdiction Issuing Jurisdiction
     */
    #[JsonProperty('issuing_jurisdiction')]
    private ?bool $issuingJurisdiction;

    /**
     * @var ?bool $nationality Nationality
     */
    #[JsonProperty('nationality')]
    private ?bool $nationality;

    /**
     * @var ?bool $residentCity Resident City
     */
    #[JsonProperty('resident_city')]
    private ?bool $residentCity;

    /**
     * @var ?bool $residentState Resident State
     */
    #[JsonProperty('resident_state')]
    private ?bool $residentState;

    /**
     * @var ?bool $residentPostalCode Resident Postal Code
     */
    #[JsonProperty('resident_postal_code')]
    private ?bool $residentPostalCode;

    /**
     * @var ?bool $residentCountry Resident Country
     */
    #[JsonProperty('resident_country')]
    private ?bool $residentCountry;

    /**
     * @var ?bool $familyNameNationalCharacter Family Name National Character
     */
    #[JsonProperty('family_name_national_character')]
    private ?bool $familyNameNationalCharacter;

    /**
     * @var ?bool $givenNameNationalCharacter Given Name National Character
     */
    #[JsonProperty('given_name_national_character')]
    private ?bool $givenNameNationalCharacter;

    /**
     * @param array{
     *   familyName?: ?bool,
     *   givenName?: ?bool,
     *   birthDate?: ?bool,
     *   issueDate?: ?bool,
     *   expiryDate?: ?bool,
     *   issuingCountry?: ?bool,
     *   issuingAuthority?: ?bool,
     *   portrait?: ?bool,
     *   drivingPrivileges?: ?bool,
     *   residentAddress?: ?bool,
     *   portraitCaptureDate?: ?bool,
     *   ageInYears?: ?bool,
     *   ageBirthYear?: ?bool,
     *   issuingJurisdiction?: ?bool,
     *   nationality?: ?bool,
     *   residentCity?: ?bool,
     *   residentState?: ?bool,
     *   residentPostalCode?: ?bool,
     *   residentCountry?: ?bool,
     *   familyNameNationalCharacter?: ?bool,
     *   givenNameNationalCharacter?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->familyName = $values['familyName'] ?? null;
        $this->givenName = $values['givenName'] ?? null;
        $this->birthDate = $values['birthDate'] ?? null;
        $this->issueDate = $values['issueDate'] ?? null;
        $this->expiryDate = $values['expiryDate'] ?? null;
        $this->issuingCountry = $values['issuingCountry'] ?? null;
        $this->issuingAuthority = $values['issuingAuthority'] ?? null;
        $this->portrait = $values['portrait'] ?? null;
        $this->drivingPrivileges = $values['drivingPrivileges'] ?? null;
        $this->residentAddress = $values['residentAddress'] ?? null;
        $this->portraitCaptureDate = $values['portraitCaptureDate'] ?? null;
        $this->ageInYears = $values['ageInYears'] ?? null;
        $this->ageBirthYear = $values['ageBirthYear'] ?? null;
        $this->issuingJurisdiction = $values['issuingJurisdiction'] ?? null;
        $this->nationality = $values['nationality'] ?? null;
        $this->residentCity = $values['residentCity'] ?? null;
        $this->residentState = $values['residentState'] ?? null;
        $this->residentPostalCode = $values['residentPostalCode'] ?? null;
        $this->residentCountry = $values['residentCountry'] ?? null;
        $this->familyNameNationalCharacter = $values['familyNameNationalCharacter'] ?? null;
        $this->givenNameNationalCharacter = $values['givenNameNationalCharacter'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getFamilyName(): ?bool
    {
        return $this->familyName;
    }

    /**
     * @param ?bool $value
     */
    public function setFamilyName(?bool $value = null): self
    {
        $this->familyName = $value;
        $this->_setField('familyName');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGivenName(): ?bool
    {
        return $this->givenName;
    }

    /**
     * @param ?bool $value
     */
    public function setGivenName(?bool $value = null): self
    {
        $this->givenName = $value;
        $this->_setField('givenName');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBirthDate(): ?bool
    {
        return $this->birthDate;
    }

    /**
     * @param ?bool $value
     */
    public function setBirthDate(?bool $value = null): self
    {
        $this->birthDate = $value;
        $this->_setField('birthDate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIssueDate(): ?bool
    {
        return $this->issueDate;
    }

    /**
     * @param ?bool $value
     */
    public function setIssueDate(?bool $value = null): self
    {
        $this->issueDate = $value;
        $this->_setField('issueDate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExpiryDate(): ?bool
    {
        return $this->expiryDate;
    }

    /**
     * @param ?bool $value
     */
    public function setExpiryDate(?bool $value = null): self
    {
        $this->expiryDate = $value;
        $this->_setField('expiryDate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIssuingCountry(): ?bool
    {
        return $this->issuingCountry;
    }

    /**
     * @param ?bool $value
     */
    public function setIssuingCountry(?bool $value = null): self
    {
        $this->issuingCountry = $value;
        $this->_setField('issuingCountry');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIssuingAuthority(): ?bool
    {
        return $this->issuingAuthority;
    }

    /**
     * @param ?bool $value
     */
    public function setIssuingAuthority(?bool $value = null): self
    {
        $this->issuingAuthority = $value;
        $this->_setField('issuingAuthority');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPortrait(): ?bool
    {
        return $this->portrait;
    }

    /**
     * @param ?bool $value
     */
    public function setPortrait(?bool $value = null): self
    {
        $this->portrait = $value;
        $this->_setField('portrait');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDrivingPrivileges(): ?bool
    {
        return $this->drivingPrivileges;
    }

    /**
     * @param ?bool $value
     */
    public function setDrivingPrivileges(?bool $value = null): self
    {
        $this->drivingPrivileges = $value;
        $this->_setField('drivingPrivileges');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getResidentAddress(): ?bool
    {
        return $this->residentAddress;
    }

    /**
     * @param ?bool $value
     */
    public function setResidentAddress(?bool $value = null): self
    {
        $this->residentAddress = $value;
        $this->_setField('residentAddress');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPortraitCaptureDate(): ?bool
    {
        return $this->portraitCaptureDate;
    }

    /**
     * @param ?bool $value
     */
    public function setPortraitCaptureDate(?bool $value = null): self
    {
        $this->portraitCaptureDate = $value;
        $this->_setField('portraitCaptureDate');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAgeInYears(): ?bool
    {
        return $this->ageInYears;
    }

    /**
     * @param ?bool $value
     */
    public function setAgeInYears(?bool $value = null): self
    {
        $this->ageInYears = $value;
        $this->_setField('ageInYears');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAgeBirthYear(): ?bool
    {
        return $this->ageBirthYear;
    }

    /**
     * @param ?bool $value
     */
    public function setAgeBirthYear(?bool $value = null): self
    {
        $this->ageBirthYear = $value;
        $this->_setField('ageBirthYear');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIssuingJurisdiction(): ?bool
    {
        return $this->issuingJurisdiction;
    }

    /**
     * @param ?bool $value
     */
    public function setIssuingJurisdiction(?bool $value = null): self
    {
        $this->issuingJurisdiction = $value;
        $this->_setField('issuingJurisdiction');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getNationality(): ?bool
    {
        return $this->nationality;
    }

    /**
     * @param ?bool $value
     */
    public function setNationality(?bool $value = null): self
    {
        $this->nationality = $value;
        $this->_setField('nationality');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getResidentCity(): ?bool
    {
        return $this->residentCity;
    }

    /**
     * @param ?bool $value
     */
    public function setResidentCity(?bool $value = null): self
    {
        $this->residentCity = $value;
        $this->_setField('residentCity');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getResidentState(): ?bool
    {
        return $this->residentState;
    }

    /**
     * @param ?bool $value
     */
    public function setResidentState(?bool $value = null): self
    {
        $this->residentState = $value;
        $this->_setField('residentState');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getResidentPostalCode(): ?bool
    {
        return $this->residentPostalCode;
    }

    /**
     * @param ?bool $value
     */
    public function setResidentPostalCode(?bool $value = null): self
    {
        $this->residentPostalCode = $value;
        $this->_setField('residentPostalCode');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getResidentCountry(): ?bool
    {
        return $this->residentCountry;
    }

    /**
     * @param ?bool $value
     */
    public function setResidentCountry(?bool $value = null): self
    {
        $this->residentCountry = $value;
        $this->_setField('residentCountry');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getFamilyNameNationalCharacter(): ?bool
    {
        return $this->familyNameNationalCharacter;
    }

    /**
     * @param ?bool $value
     */
    public function setFamilyNameNationalCharacter(?bool $value = null): self
    {
        $this->familyNameNationalCharacter = $value;
        $this->_setField('familyNameNationalCharacter');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGivenNameNationalCharacter(): ?bool
    {
        return $this->givenNameNationalCharacter;
    }

    /**
     * @param ?bool $value
     */
    public function setGivenNameNationalCharacter(?bool $value = null): self
    {
        $this->givenNameNationalCharacter = $value;
        $this->_setField('givenNameNationalCharacter');
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
