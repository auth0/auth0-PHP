<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The Auth0 Connection used for the authentication transaction that generated the event.
 */
class EventStreamCloudEventContextConnection extends JsonSerializableType
{
    /**
     * @var string $id The ID of the connection.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $name The name of the connection.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $strategy The auth strategy implemented by the connection.
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   strategy: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->strategy = $values['strategy'];
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
     * @return string
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param string $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
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
