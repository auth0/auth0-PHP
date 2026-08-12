<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Slack team or workspace name usually first segment in your Slack URL. e.g. `https://acme-org.slack.com` would be `acme-org`.
 */
class ClientAddonSlack extends JsonSerializableType
{
    /**
     * @var string $team Slack team name.
     */
    #[JsonProperty('team')]
    private string $team;

    /**
     * @param array{
     *   team: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->team = $values['team'];
    }

    /**
     * @return string
     */
    public function getTeam(): string
    {
        return $this->team;
    }

    /**
     * @param string $value
     */
    public function setTeam(string $value): self
    {
        $this->team = $value;
        $this->_setField('team');
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
