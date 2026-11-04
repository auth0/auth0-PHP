<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Exception;

class SidebarComponent extends JsonSerializableType
{
    /**
     * @var (
     *    'sidebar:component:auth0:external_link'
     *   |'sidebar:component:auth0:internal_link'
     *   |'sidebar:component:auth0:external_link:v2'
     *   |'sidebar:component:auth0:internal_link:v2'
     *   |'_unknown'
     * ) $type
     */
    private readonly string $type;

    /**
     * @var (
     *    SidebarComponentAuth0ExternalLink
     *   |SidebarComponentAuth0InternalLink
     *   |SidebarComponentAuth0ExternalLinkV2
     *   |SidebarComponentAuth0InternalLinkV2
     *   |mixed
     * ) $value
     */
    private readonly mixed $value;

    /**
     * @param array{
     *   type: (
     *    'sidebar:component:auth0:external_link'
     *   |'sidebar:component:auth0:internal_link'
     *   |'sidebar:component:auth0:external_link:v2'
     *   |'sidebar:component:auth0:internal_link:v2'
     *   |'_unknown'
     * ),
     *   value: (
     *    SidebarComponentAuth0ExternalLink
     *   |SidebarComponentAuth0InternalLink
     *   |SidebarComponentAuth0ExternalLinkV2
     *   |SidebarComponentAuth0InternalLinkV2
     *   |mixed
     * ),
     * } $values
     */
    private function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->value = $values['value'];
    }

    /**
     * @return (
     *    'sidebar:component:auth0:external_link'
     *   |'sidebar:component:auth0:internal_link'
     *   |'sidebar:component:auth0:external_link:v2'
     *   |'sidebar:component:auth0:internal_link:v2'
     *   |'_unknown'
     * )
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return (
     *    SidebarComponentAuth0ExternalLink
     *   |SidebarComponentAuth0InternalLink
     *   |SidebarComponentAuth0ExternalLinkV2
     *   |SidebarComponentAuth0InternalLinkV2
     *   |mixed
     * )
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @param SidebarComponentAuth0ExternalLink $sidebarComponentAuth0ExternalLink
     * @return SidebarComponent
     */
    public static function sidebarComponentAuth0ExternalLink(SidebarComponentAuth0ExternalLink $sidebarComponentAuth0ExternalLink): SidebarComponent
    {
        return new SidebarComponent([
            'type' => 'sidebar:component:auth0:external_link',
            'value' => $sidebarComponentAuth0ExternalLink,
        ]);
    }

    /**
     * @param SidebarComponentAuth0InternalLink $sidebarComponentAuth0InternalLink
     * @return SidebarComponent
     */
    public static function sidebarComponentAuth0InternalLink(SidebarComponentAuth0InternalLink $sidebarComponentAuth0InternalLink): SidebarComponent
    {
        return new SidebarComponent([
            'type' => 'sidebar:component:auth0:internal_link',
            'value' => $sidebarComponentAuth0InternalLink,
        ]);
    }

    /**
     * @param SidebarComponentAuth0ExternalLinkV2 $sidebarComponentAuth0ExternalLinkV2
     * @return SidebarComponent
     */
    public static function sidebarComponentAuth0ExternalLinkV2(SidebarComponentAuth0ExternalLinkV2 $sidebarComponentAuth0ExternalLinkV2): SidebarComponent
    {
        return new SidebarComponent([
            'type' => 'sidebar:component:auth0:external_link:v2',
            'value' => $sidebarComponentAuth0ExternalLinkV2,
        ]);
    }

    /**
     * @param SidebarComponentAuth0InternalLinkV2 $sidebarComponentAuth0InternalLinkV2
     * @return SidebarComponent
     */
    public static function sidebarComponentAuth0InternalLinkV2(SidebarComponentAuth0InternalLinkV2 $sidebarComponentAuth0InternalLinkV2): SidebarComponent
    {
        return new SidebarComponent([
            'type' => 'sidebar:component:auth0:internal_link:v2',
            'value' => $sidebarComponentAuth0InternalLinkV2,
        ]);
    }

    /**
     * @return bool
     */
    public function isSidebarComponentAuth0ExternalLink(): bool
    {
        return $this->value instanceof SidebarComponentAuth0ExternalLink && $this->type === 'sidebar:component:auth0:external_link';
    }

    /**
     * @return SidebarComponentAuth0ExternalLink
     */
    public function asSidebarComponentAuth0ExternalLink(): SidebarComponentAuth0ExternalLink
    {
        if (!($this->value instanceof SidebarComponentAuth0ExternalLink && $this->type === 'sidebar:component:auth0:external_link')) {
            throw new Exception(
                "Expected sidebar:component:auth0:external_link; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isSidebarComponentAuth0InternalLink(): bool
    {
        return $this->value instanceof SidebarComponentAuth0InternalLink && $this->type === 'sidebar:component:auth0:internal_link';
    }

    /**
     * @return SidebarComponentAuth0InternalLink
     */
    public function asSidebarComponentAuth0InternalLink(): SidebarComponentAuth0InternalLink
    {
        if (!($this->value instanceof SidebarComponentAuth0InternalLink && $this->type === 'sidebar:component:auth0:internal_link')) {
            throw new Exception(
                "Expected sidebar:component:auth0:internal_link; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isSidebarComponentAuth0ExternalLinkV2(): bool
    {
        return $this->value instanceof SidebarComponentAuth0ExternalLinkV2 && $this->type === 'sidebar:component:auth0:external_link:v2';
    }

    /**
     * @return SidebarComponentAuth0ExternalLinkV2
     */
    public function asSidebarComponentAuth0ExternalLinkV2(): SidebarComponentAuth0ExternalLinkV2
    {
        if (!($this->value instanceof SidebarComponentAuth0ExternalLinkV2 && $this->type === 'sidebar:component:auth0:external_link:v2')) {
            throw new Exception(
                "Expected sidebar:component:auth0:external_link:v2; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isSidebarComponentAuth0InternalLinkV2(): bool
    {
        return $this->value instanceof SidebarComponentAuth0InternalLinkV2 && $this->type === 'sidebar:component:auth0:internal_link:v2';
    }

    /**
     * @return SidebarComponentAuth0InternalLinkV2
     */
    public function asSidebarComponentAuth0InternalLinkV2(): SidebarComponentAuth0InternalLinkV2
    {
        if (!($this->value instanceof SidebarComponentAuth0InternalLinkV2 && $this->type === 'sidebar:component:auth0:internal_link:v2')) {
            throw new Exception(
                "Expected sidebar:component:auth0:internal_link:v2; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        $result = [];
        $result['type'] = $this->type;

        $base = parent::jsonSerialize();
        $result = array_merge($base, $result);

        switch ($this->type) {
            case 'sidebar:component:auth0:external_link':
                $value = $this->asSidebarComponentAuth0ExternalLink()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'sidebar:component:auth0:internal_link':
                $value = $this->asSidebarComponentAuth0InternalLink()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'sidebar:component:auth0:external_link:v2':
                $value = $this->asSidebarComponentAuth0ExternalLinkV2()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'sidebar:component:auth0:internal_link:v2':
                $value = $this->asSidebarComponentAuth0InternalLinkV2()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case '_unknown':
            default:
                if (is_null($this->value)) {
                    break;
                }
                if ($this->value instanceof JsonSerializableType) {
                    $value = $this->value->jsonSerialize();
                    $result = array_merge($value, $result);
                } elseif (is_array($this->value)) {
                    $result = array_merge($this->value, $result);
                }
        }

        return $result;
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function jsonDeserialize(array $data): static
    {
        $args = [];
        if (!array_key_exists('type', $data)) {
            throw new Exception(
                "JSON data is missing property 'type'",
            );
        }
        $type = $data['type'];
        if (!(is_string($type))) {
            throw new Exception(
                "Expected property 'type' in JSON data to be string, instead received " . get_debug_type($data['type']),
            );
        }

        $args['type'] = $type;
        switch ($type) {
            case 'sidebar:component:auth0:external_link':
                $args['value'] = SidebarComponentAuth0ExternalLink::jsonDeserialize($data);
                break;
            case 'sidebar:component:auth0:internal_link':
                $args['value'] = SidebarComponentAuth0InternalLink::jsonDeserialize($data);
                break;
            case 'sidebar:component:auth0:external_link:v2':
                $args['value'] = SidebarComponentAuth0ExternalLinkV2::jsonDeserialize($data);
                break;
            case 'sidebar:component:auth0:internal_link:v2':
                $args['value'] = SidebarComponentAuth0InternalLinkV2::jsonDeserialize($data);
                break;
            case '_unknown':
            default:
                $args['type'] = '_unknown';
                $args['value'] = $data;
        }

        // @phpstan-ignore-next-line
        return new static($args);
    }
}
