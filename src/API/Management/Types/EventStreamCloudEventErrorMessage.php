<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * An error message delivered via the SSE stream. The stream closes after this message.
 */
class EventStreamCloudEventErrorMessage extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventErrorDetail $error
     */
    #[JsonProperty('error')]
    private EventStreamCloudEventErrorDetail $error;

    /**
     * @param array{
     *   error: EventStreamCloudEventErrorDetail,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->error = $values['error'];
    }

    /**
     * @return EventStreamCloudEventErrorDetail
     */
    public function getError(): EventStreamCloudEventErrorDetail
    {
        return $this->error;
    }

    /**
     * @param EventStreamCloudEventErrorDetail $value
     */
    public function setError(EventStreamCloudEventErrorDetail $value): self
    {
        $this->error = $value;
        $this->_setField('error');
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
