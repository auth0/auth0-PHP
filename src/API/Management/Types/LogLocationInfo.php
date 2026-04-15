<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Information about the location that triggered this event based on the `ip`.
 */
class LogLocationInfo extends JsonSerializableType
{
    /**
     * @var ?string $countryCode Two-letter <a href="https://www.iso.org/iso-3166-country-codes.html">Alpha-2 ISO 3166-1</a> country code.
     */
    #[JsonProperty('country_code')]
    private ?string $countryCode;

    /**
     * @var ?string $countryCode3 Three-letter <a href="https://www.iso.org/iso-3166-country-codes.html">Alpha-3 ISO 3166-1</a> country code.
     */
    #[JsonProperty('country_code3')]
    private ?string $countryCode3;

    /**
     * @var ?string $countryName Full country name in English.
     */
    #[JsonProperty('country_name')]
    private ?string $countryName;

    /**
     * @var ?string $cityName Full city name in English.
     */
    #[JsonProperty('city_name')]
    private ?string $cityName;

    /**
     * @var ?float $latitude Global latitude (horizontal) position.
     */
    #[JsonProperty('latitude')]
    private ?float $latitude;

    /**
     * @var ?float $longitude Global longitude (vertical) position.
     */
    #[JsonProperty('longitude')]
    private ?float $longitude;

    /**
     * @var ?string $timeZone Time zone name as found in the <a href="https://www.iana.org/time-zones">tz database</a>.
     */
    #[JsonProperty('time_zone')]
    private ?string $timeZone;

    /**
     * @var ?string $continentCode Continent the country is located within. Can be `AF` (Africa), `AN` (Antarctica), `AS` (Asia), `EU` (Europe), `NA` (North America), `OC` (Oceania) or `SA` (South America).
     */
    #[JsonProperty('continent_code')]
    private ?string $continentCode;

    /**
     * @param array{
     *   countryCode?: ?string,
     *   countryCode3?: ?string,
     *   countryName?: ?string,
     *   cityName?: ?string,
     *   latitude?: ?float,
     *   longitude?: ?float,
     *   timeZone?: ?string,
     *   continentCode?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->countryCode = $values['countryCode'] ?? null;
        $this->countryCode3 = $values['countryCode3'] ?? null;
        $this->countryName = $values['countryName'] ?? null;
        $this->cityName = $values['cityName'] ?? null;
        $this->latitude = $values['latitude'] ?? null;
        $this->longitude = $values['longitude'] ?? null;
        $this->timeZone = $values['timeZone'] ?? null;
        $this->continentCode = $values['continentCode'] ?? null;
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
    public function getCountryCode3(): ?string
    {
        return $this->countryCode3;
    }

    /**
     * @param ?string $value
     */
    public function setCountryCode3(?string $value = null): self
    {
        $this->countryCode3 = $value;
        $this->_setField('countryCode3');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
