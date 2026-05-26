<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Geographic information about the request origin.
 */
class EventStreamCloudEventContextRequestGeo extends JsonSerializableType
{
    /**
     * @var ?string $continentCode Continent code.
     */
    #[JsonProperty('continent_code')]
    private ?string $continentCode;

    /**
     * @var ?string $countryCode Country code.
     */
    #[JsonProperty('country_code')]
    private ?string $countryCode;

    /**
     * @var ?string $countryName Country name.
     */
    #[JsonProperty('country_name')]
    private ?string $countryName;

    /**
     * @var ?float $latitude Latitude coordinate.
     */
    #[JsonProperty('latitude')]
    private ?float $latitude;

    /**
     * @var ?float $longitude Longitude coordinate.
     */
    #[JsonProperty('longitude')]
    private ?float $longitude;

    /**
     * @var ?string $subdivisionCode Subdivision (state/province) code.
     */
    #[JsonProperty('subdivision_code')]
    private ?string $subdivisionCode;

    /**
     * @var ?string $subdivisionName Subdivision (state/province) name.
     */
    #[JsonProperty('subdivision_name')]
    private ?string $subdivisionName;

    /**
     * @var ?string $cityName City name.
     */
    #[JsonProperty('city_name')]
    private ?string $cityName;

    /**
     * @var ?string $timeZone Time zone.
     */
    #[JsonProperty('time_zone')]
    private ?string $timeZone;

    /**
     * @param array{
     *   continentCode?: ?string,
     *   countryCode?: ?string,
     *   countryName?: ?string,
     *   latitude?: ?float,
     *   longitude?: ?float,
     *   subdivisionCode?: ?string,
     *   subdivisionName?: ?string,
     *   cityName?: ?string,
     *   timeZone?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->continentCode = $values['continentCode'] ?? null;
        $this->countryCode = $values['countryCode'] ?? null;
        $this->countryName = $values['countryName'] ?? null;
        $this->latitude = $values['latitude'] ?? null;
        $this->longitude = $values['longitude'] ?? null;
        $this->subdivisionCode = $values['subdivisionCode'] ?? null;
        $this->subdivisionName = $values['subdivisionName'] ?? null;
        $this->cityName = $values['cityName'] ?? null;
        $this->timeZone = $values['timeZone'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getContinentCode(): ?string
    {
        return $this->continentCode;
    }

    /**
     * @param ?string $value
     */
    public function setContinentCode(?string $value = null): self
    {
        $this->continentCode = $value;
        $this->_setField('continentCode');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param ?string $value
     */
    public function setCountryCode(?string $value = null): self
    {
        $this->countryCode = $value;
        $this->_setField('countryCode');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    /**
     * @param ?string $value
     */
    public function setCountryName(?string $value = null): self
    {
        $this->countryName = $value;
        $this->_setField('countryName');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param ?float $value
     */
    public function setLatitude(?float $value = null): self
    {
        $this->latitude = $value;
        $this->_setField('latitude');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param ?float $value
     */
    public function setLongitude(?float $value = null): self
    {
        $this->longitude = $value;
        $this->_setField('longitude');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSubdivisionCode(): ?string
    {
        return $this->subdivisionCode;
    }

    /**
     * @param ?string $value
     */
    public function setSubdivisionCode(?string $value = null): self
    {
        $this->subdivisionCode = $value;
        $this->_setField('subdivisionCode');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSubdivisionName(): ?string
    {
        return $this->subdivisionName;
    }

    /**
     * @param ?string $value
     */
    public function setSubdivisionName(?string $value = null): self
    {
        $this->subdivisionName = $value;
        $this->_setField('subdivisionName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    /**
     * @param ?string $value
     */
    public function setCityName(?string $value = null): self
    {
        $this->cityName = $value;
        $this->_setField('cityName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTimeZone(): ?string
    {
        return $this->timeZone;
    }

    /**
     * @param ?string $value
     */
    public function setTimeZone(?string $value = null): self
    {
        $this->timeZone = $value;
        $this->_setField('timeZone');
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
