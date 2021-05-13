<?php

declare(strict_types=1);

namespace Auth0\SDK\Helpers\Requests;

/**
 * Class FilteredRequest.
 */
class FilteredRequest
{
    /**
     * Internal state of the field-filtered request.
     */
    protected array $state = [];

    /**
     * FilteredRequest constructor
     *
     * @param array|null $fields        Fields to include or exclude from API responses.
     * @param bool|null  $includeFields True to include $fields, false to exclude $fields.
     */
    public function __construct(
        ?array $fields = null,
        ?bool $includeFields = null
    ) {
        $this->state['fields'] = $fields ?? [];
        $this->state['include_fields'] = $includeFields;
    }

    /**
     * Set the `fields` for the filtered request.
     *
     * @param array $fields Value of `fields` parameter for the filtered request.
     */
    public function setFields(
        array $fields
    ): self {
        $this->state['fields'] = $fields;

        return $this;
    }

    /**
     * Clear the `fields` for the filtered request.
     */
    public function clearFields(): self
    {
        $this->state['fields'] = [];

        return $this;
    }

    /**
     * Retrieve the `fields` for the filtered request.
     *
     * @return array
     */
    public function getFields(): array
    {
        return array_keys($this->state['fields']);
    }

    /**
     * Add a value to `fields` for the filtered request.
     *
     * @param string $field Value of `field` parameter for the filtered request.
     */
    public function addField(
        string $field
    ): self {
        $this->state['fields'][$field] = true;
        return $this;
    }

    /**
     * Add a value to `fields` for the filtered request.
     *
     * @param string $field Value of `field` parameter for the filtered request.
     */
    public function removeField(
        string $field
    ): self {
        if (isset($this->state['fields'][$field])) {
            unset($this->state['fields'][$field]);
        }

        return $this;
    }

    /**
     * Set the `include_fields` for the paginated request.
     *
     * @param ?bool $includeFields Value of `include_fields` parameter for the filtered request.
     */
    public function setIncludeFields(
        ?bool $includeFields
    ): self {
        $this->state['include_fields'] = $includeFields;

        return $this;
    }

    /**
     * Retrieve the `include_fields` for the filtered request.
     */
    public function getIncludeFields(): ?int
    {
        return $this->state['include_fields'];
    }

    /**
     * Return an array representing the field-filtered request.
     *
     * @return array
     */
    public function build(): array
    {
        $response = [];

        if (count($this->state['fields'])) {
            $response['fields'] = implode(',', array_keys($this->state['fields']));

            if ($this->state['include_fields'] !== null) {
                $response['include_fields'] = $this->state['include_fields'];
            }
        }

        return $response;
    }
}
