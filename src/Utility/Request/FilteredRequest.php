<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Request;

use function count;

final class FilteredRequest
{
    /**
     * FilteredRequest constructor.
     *
     * @param null|array<string> $fields        fields to include or exclude from API responses
     * @param null|bool          $includeFields true to include $fields, false to exclude $fields
     */
    public function __construct(
        private ?array $fields = null,
        private ?bool $includeFields = null,
    ) {
    }

    /**
     * Return an array representing the field-filtered request.
     *
     * @return array<int|string>
     */
    public function build(): array
    {
        $response = [];

        if (null !== $this->fields && count($this->fields) >= 1) {
            $response['fields'] = implode(',', array_unique(array_values($this->fields)));

            if (null !== $this->includeFields) {
                $response['include_fields'] = $this->includeFields ? 'true' : 'false';
            }
        }

        return $response;
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
     * @return null|array<string>
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * Retrieve the `include_fields` for the filtered request.
     */
    public function getIncludeFields(): ?bool
    {
        return $this->includeFields;
    }

    /**
     * Set the `fields` for the filtered request.
     *
     * @param array<string> $fields value of `fields` parameter for the filtered request
     */
    public function setFields(
        array $fields,
    ): self {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Set the `include_fields` for the paginated request.
     *
     * @param ?bool $includeFields value of `include_fields` parameter for the filtered request
     */
    public function setIncludeFields(
        ?bool $includeFields,
    ): self {
        $this->includeFields = $includeFields;

        return $this;
    }
}
