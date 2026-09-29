<?php

namespace Auth0\SDK\API\Management\UserBlocks\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListUserBlocksRequestParameters extends JsonSerializableType
{
    /**
     *
     *           If true, returns only blocks that are currently enforced (e.g. subject to protection status, IP allowlist, etc.).
     *           If false or omitted, returns all blocks regardless of enforcement state.
     *
     *
     * @var ?bool $considerBruteForceEnablement
     */
    private ?bool $considerBruteForceEnablement;

    /**
     * @param array{
     *   considerBruteForceEnablement?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->considerBruteForceEnablement = $values['considerBruteForceEnablement'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getConsiderBruteForceEnablement(): ?bool
    {
        return $this->considerBruteForceEnablement;
    }

    /**
     * @param ?bool $value
     */
    public function setConsiderBruteForceEnablement(?bool $value = null): self
    {
        $this->considerBruteForceEnablement = $value;
        $this->_setField('considerBruteForceEnablement');
        return $this;
    }
}
