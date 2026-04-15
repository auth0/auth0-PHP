<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsOAuth1Common;

/**
 * Options for the evernote family of connections
 */
class ConnectionOptionsEvernote extends JsonSerializableType
{
    use ConnectionOptionsOAuth1Common;


    /**
     * @param array{
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   nonPersistentAttrs?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
