<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetJobResponseContent extends JsonSerializableType
{
    /**
     * @var string $status Status of this job.
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @var string $type Type of job this is.
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var ?string $createdAt When this job was created.
     */
    #[JsonProperty('created_at')]
    private ?string $createdAt;

    /**
     * @var string $id ID of this job.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?string $connectionId connection_id of the connection this job uses.
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @var ?string $location URL to download the result of this job.
     */
    #[JsonProperty('location')]
    private ?string $location;

    /**
     * @var ?int $percentageDone Completion percentage of this job.
     */
    #[JsonProperty('percentage_done')]
    private ?int $percentageDone;

    /**
     * @var ?int $timeLeftSeconds Estimated time remaining before job completes.
     */
    #[JsonProperty('time_left_seconds')]
    private ?int $timeLeftSeconds;

    /**
     * @var ?value-of<JobFileFormatEnum> $format
     */
    #[JsonProperty('format')]
    private ?string $format;

    /**
     * @var ?string $statusDetails Status details.
     */
    #[JsonProperty('status_details')]
    private ?string $statusDetails;

    /**
     * @var ?GetJobSummary $summary
     */
    #[JsonProperty('summary')]
    private ?GetJobSummary $summary;

    /**
     * @param array{
     *   status: string,
     *   type: string,
     *   id: string,
     *   createdAt?: ?string,
     *   connectionId?: ?string,
     *   location?: ?string,
     *   percentageDone?: ?int,
     *   timeLeftSeconds?: ?int,
     *   format?: ?value-of<JobFileFormatEnum>,
     *   statusDetails?: ?string,
     *   summary?: ?GetJobSummary,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
        $this->type = $values['type'];
        $this->createdAt = $values['createdAt'] ?? null;
        $this->id = $values['id'];
        $this->connectionId = $values['connectionId'] ?? null;
        $this->location = $values['location'] ?? null;
        $this->percentageDone = $values['percentageDone'] ?? null;
        $this->timeLeftSeconds = $values['timeLeftSeconds'] ?? null;
        $this->format = $values['format'] ?? null;
        $this->statusDetails = $values['statusDetails'] ?? null;
        $this->summary = $values['summary'] ?? null;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param ?string $value
     */
    public function setCreatedAt(?string $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
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
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param ?string $value
     */
    public function setLocation(?string $value = null): self
    {
        $this->location = $value;
        $this->_setField('location');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getPercentageDone(): ?int
    {
        return $this->percentageDone;
    }

    /**
     * @param ?int $value
     */
    public function setPercentageDone(?int $value = null): self
    {
        $this->percentageDone = $value;
        $this->_setField('percentageDone');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTimeLeftSeconds(): ?int
    {
        return $this->timeLeftSeconds;
    }

    /**
     * @param ?int $value
     */
    public function setTimeLeftSeconds(?int $value = null): self
    {
        $this->timeLeftSeconds = $value;
        $this->_setField('timeLeftSeconds');
        return $this;
    }

    /**
     * @return ?value-of<JobFileFormatEnum>
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param ?value-of<JobFileFormatEnum> $value
     */
    public function setFormat(?string $value = null): self
    {
        $this->format = $value;
        $this->_setField('format');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getStatusDetails(): ?string
    {
        return $this->statusDetails;
    }

    /**
     * @param ?string $value
     */
    public function setStatusDetails(?string $value = null): self
    {
        $this->statusDetails = $value;
        $this->_setField('statusDetails');
        return $this;
    }

    /**
     * @return ?GetJobSummary
     */
    public function getSummary(): ?GetJobSummary
    {
        return $this->summary;
    }

    /**
     * @param ?GetJobSummary $value
     */
    public function setSummary(?GetJobSummary $value = null): self
    {
        $this->summary = $value;
        $this->_setField('summary');
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
