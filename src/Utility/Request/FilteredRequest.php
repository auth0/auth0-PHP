<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Request;

/**
 * Class FilteredRequest.
 */
final class FilteredRequest
{
    /**
     * FilteredRequest constructor
     *
     * @param array<string>|null $fields        Fields to include or exclude from API responses.
     * @param bool|null          $includeFields True to include $fields, false to exclude $fields.
     */
    public function __construct(
        private ?array $fields = null,
        private ?bool $includeFields = null
    ) {
    }

    /**
     * Set the `fields` for the filtered request.
     *
     * @param array<string> $fields Value of `fields` parameter for the filtered request.
     */
    public function setFields(
        array $fields
    ): self {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Clear the `fields` for the filtered request.
     */
    public function clearFields(): self
    {
        $this->fields = null;

        return $this;
    }

    /**
     * Retrieve the `fields` for the filtered request.
     *
     * @return array<string>|null
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * Set the `include_fields` for the paginated request.
     *
     * @param ?bool $includeFields Value of `include_fields` parameter for the filtered request.
     */
    public function setIncludeFields(
        ?bool $includeFields
    ): self {
        $this->includeFields = $includeFields;

        return $this;
    }

    /**
     * Retrieve the `include_fields` for the filtered request.
     */
    public function getIncludeFields(): ?bool
    {
        return $this->includeFields;
    }

    /**
     * Return an array representing the field-filtered request.
     *
     * @return array<int|string>
     */
    public function build(): array
    {
        $response = [];

        if ($this->fields !== null && count($this->fields) >= 1) {
            $response['fields'] = implode(',', array_unique(array_values($this->fields)));

            if ($this->includeFields !== null) {
                $response['include_fields'] = $this->includeFields ? 'true' : 'false';
            }
        }

        return $response;
    }
}
