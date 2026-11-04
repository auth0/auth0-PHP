<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Exception;

class PageComponent extends JsonSerializableType
{
    /**
     * @var (
     *    'page:component:auth0:form'
     *   |'page:component:auth0:typography:heading'
     *   |'page:component:auth0:media:image'
     *   |'page:component:auth0:typography:rich_text'
     *   |'page:component:auth0:structure:section'
     *   |'page:component:auth0:structure:separator'
     *   |'page:component:auth0:my_organization:domain_table'
     *   |'page:component:auth0:my_organization:member_management'
     *   |'page:component:auth0:my_organization:details_edit'
     *   |'page:component:auth0:my_account:passkey_management'
     *   |'page:component:auth0:my_account:mfa_management'
     *   |'_unknown'
     * ) $type
     */
    private readonly string $type;

    /**
     * @var (
     *    PageComponentAuth0Form
     *   |PageComponentAuth0TypographyHeading
     *   |PageComponentAuth0MediaImage
     *   |PageComponentAuth0TypographyRichText
     *   |PageComponentAuth0StructureSection
     *   |PageComponentAuth0StructureSeparator
     *   |PageComponentAuth0MyOrganizationDomainTable
     *   |PageComponentAuth0MyOrganizationMemberManagement
     *   |PageComponentAuth0MyOrganizationDetailsEdit
     *   |PageComponentAuth0MyAccountPasskeyManagement
     *   |PageComponentAuth0MyAccountMfaManagement
     *   |mixed
     * ) $value
     */
    private readonly mixed $value;

    /**
     * @param array{
     *   type: (
     *    'page:component:auth0:form'
     *   |'page:component:auth0:typography:heading'
     *   |'page:component:auth0:media:image'
     *   |'page:component:auth0:typography:rich_text'
     *   |'page:component:auth0:structure:section'
     *   |'page:component:auth0:structure:separator'
     *   |'page:component:auth0:my_organization:domain_table'
     *   |'page:component:auth0:my_organization:member_management'
     *   |'page:component:auth0:my_organization:details_edit'
     *   |'page:component:auth0:my_account:passkey_management'
     *   |'page:component:auth0:my_account:mfa_management'
     *   |'_unknown'
     * ),
     *   value: (
     *    PageComponentAuth0Form
     *   |PageComponentAuth0TypographyHeading
     *   |PageComponentAuth0MediaImage
     *   |PageComponentAuth0TypographyRichText
     *   |PageComponentAuth0StructureSection
     *   |PageComponentAuth0StructureSeparator
     *   |PageComponentAuth0MyOrganizationDomainTable
     *   |PageComponentAuth0MyOrganizationMemberManagement
     *   |PageComponentAuth0MyOrganizationDetailsEdit
     *   |PageComponentAuth0MyAccountPasskeyManagement
     *   |PageComponentAuth0MyAccountMfaManagement
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
     *    'page:component:auth0:form'
     *   |'page:component:auth0:typography:heading'
     *   |'page:component:auth0:media:image'
     *   |'page:component:auth0:typography:rich_text'
     *   |'page:component:auth0:structure:section'
     *   |'page:component:auth0:structure:separator'
     *   |'page:component:auth0:my_organization:domain_table'
     *   |'page:component:auth0:my_organization:member_management'
     *   |'page:component:auth0:my_organization:details_edit'
     *   |'page:component:auth0:my_account:passkey_management'
     *   |'page:component:auth0:my_account:mfa_management'
     *   |'_unknown'
     * )
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return (
     *    PageComponentAuth0Form
     *   |PageComponentAuth0TypographyHeading
     *   |PageComponentAuth0MediaImage
     *   |PageComponentAuth0TypographyRichText
     *   |PageComponentAuth0StructureSection
     *   |PageComponentAuth0StructureSeparator
     *   |PageComponentAuth0MyOrganizationDomainTable
     *   |PageComponentAuth0MyOrganizationMemberManagement
     *   |PageComponentAuth0MyOrganizationDetailsEdit
     *   |PageComponentAuth0MyAccountPasskeyManagement
     *   |PageComponentAuth0MyAccountMfaManagement
     *   |mixed
     * )
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @param PageComponentAuth0Form $pageComponentAuth0Form
     * @return PageComponent
     */
    public static function pageComponentAuth0Form(PageComponentAuth0Form $pageComponentAuth0Form): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:form',
            'value' => $pageComponentAuth0Form,
        ]);
    }

    /**
     * @param PageComponentAuth0TypographyHeading $pageComponentAuth0TypographyHeading
     * @return PageComponent
     */
    public static function pageComponentAuth0TypographyHeading(PageComponentAuth0TypographyHeading $pageComponentAuth0TypographyHeading): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:typography:heading',
            'value' => $pageComponentAuth0TypographyHeading,
        ]);
    }

    /**
     * @param PageComponentAuth0MediaImage $pageComponentAuth0MediaImage
     * @return PageComponent
     */
    public static function pageComponentAuth0MediaImage(PageComponentAuth0MediaImage $pageComponentAuth0MediaImage): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:media:image',
            'value' => $pageComponentAuth0MediaImage,
        ]);
    }

    /**
     * @param PageComponentAuth0TypographyRichText $pageComponentAuth0TypographyRichText
     * @return PageComponent
     */
    public static function pageComponentAuth0TypographyRichText(PageComponentAuth0TypographyRichText $pageComponentAuth0TypographyRichText): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:typography:rich_text',
            'value' => $pageComponentAuth0TypographyRichText,
        ]);
    }

    /**
     * @param PageComponentAuth0StructureSection $pageComponentAuth0StructureSection
     * @return PageComponent
     */
    public static function pageComponentAuth0StructureSection(PageComponentAuth0StructureSection $pageComponentAuth0StructureSection): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:structure:section',
            'value' => $pageComponentAuth0StructureSection,
        ]);
    }

    /**
     * @param PageComponentAuth0StructureSeparator $pageComponentAuth0StructureSeparator
     * @return PageComponent
     */
    public static function pageComponentAuth0StructureSeparator(PageComponentAuth0StructureSeparator $pageComponentAuth0StructureSeparator): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:structure:separator',
            'value' => $pageComponentAuth0StructureSeparator,
        ]);
    }

    /**
     * @param PageComponentAuth0MyOrganizationDomainTable $pageComponentAuth0MyOrganizationDomainTable
     * @return PageComponent
     */
    public static function pageComponentAuth0MyOrganizationDomainTable(PageComponentAuth0MyOrganizationDomainTable $pageComponentAuth0MyOrganizationDomainTable): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:my_organization:domain_table',
            'value' => $pageComponentAuth0MyOrganizationDomainTable,
        ]);
    }

    /**
     * @param PageComponentAuth0MyOrganizationMemberManagement $pageComponentAuth0MyOrganizationMemberManagement
     * @return PageComponent
     */
    public static function pageComponentAuth0MyOrganizationMemberManagement(PageComponentAuth0MyOrganizationMemberManagement $pageComponentAuth0MyOrganizationMemberManagement): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:my_organization:member_management',
            'value' => $pageComponentAuth0MyOrganizationMemberManagement,
        ]);
    }

    /**
     * @param PageComponentAuth0MyOrganizationDetailsEdit $pageComponentAuth0MyOrganizationDetailsEdit
     * @return PageComponent
     */
    public static function pageComponentAuth0MyOrganizationDetailsEdit(PageComponentAuth0MyOrganizationDetailsEdit $pageComponentAuth0MyOrganizationDetailsEdit): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:my_organization:details_edit',
            'value' => $pageComponentAuth0MyOrganizationDetailsEdit,
        ]);
    }

    /**
     * @param PageComponentAuth0MyAccountPasskeyManagement $pageComponentAuth0MyAccountPasskeyManagement
     * @return PageComponent
     */
    public static function pageComponentAuth0MyAccountPasskeyManagement(PageComponentAuth0MyAccountPasskeyManagement $pageComponentAuth0MyAccountPasskeyManagement): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:my_account:passkey_management',
            'value' => $pageComponentAuth0MyAccountPasskeyManagement,
        ]);
    }

    /**
     * @param PageComponentAuth0MyAccountMfaManagement $pageComponentAuth0MyAccountMfaManagement
     * @return PageComponent
     */
    public static function pageComponentAuth0MyAccountMfaManagement(PageComponentAuth0MyAccountMfaManagement $pageComponentAuth0MyAccountMfaManagement): PageComponent
    {
        return new PageComponent([
            'type' => 'page:component:auth0:my_account:mfa_management',
            'value' => $pageComponentAuth0MyAccountMfaManagement,
        ]);
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0Form(): bool
    {
        return $this->value instanceof PageComponentAuth0Form && $this->type === 'page:component:auth0:form';
    }

    /**
     * @return PageComponentAuth0Form
     */
    public function asPageComponentAuth0Form(): PageComponentAuth0Form
    {
        if (!($this->value instanceof PageComponentAuth0Form && $this->type === 'page:component:auth0:form')) {
            throw new Exception(
                "Expected page:component:auth0:form; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0TypographyHeading(): bool
    {
        return $this->value instanceof PageComponentAuth0TypographyHeading && $this->type === 'page:component:auth0:typography:heading';
    }

    /**
     * @return PageComponentAuth0TypographyHeading
     */
    public function asPageComponentAuth0TypographyHeading(): PageComponentAuth0TypographyHeading
    {
        if (!($this->value instanceof PageComponentAuth0TypographyHeading && $this->type === 'page:component:auth0:typography:heading')) {
            throw new Exception(
                "Expected page:component:auth0:typography:heading; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0MediaImage(): bool
    {
        return $this->value instanceof PageComponentAuth0MediaImage && $this->type === 'page:component:auth0:media:image';
    }

    /**
     * @return PageComponentAuth0MediaImage
     */
    public function asPageComponentAuth0MediaImage(): PageComponentAuth0MediaImage
    {
        if (!($this->value instanceof PageComponentAuth0MediaImage && $this->type === 'page:component:auth0:media:image')) {
            throw new Exception(
                "Expected page:component:auth0:media:image; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0TypographyRichText(): bool
    {
        return $this->value instanceof PageComponentAuth0TypographyRichText && $this->type === 'page:component:auth0:typography:rich_text';
    }

    /**
     * @return PageComponentAuth0TypographyRichText
     */
    public function asPageComponentAuth0TypographyRichText(): PageComponentAuth0TypographyRichText
    {
        if (!($this->value instanceof PageComponentAuth0TypographyRichText && $this->type === 'page:component:auth0:typography:rich_text')) {
            throw new Exception(
                "Expected page:component:auth0:typography:rich_text; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0StructureSection(): bool
    {
        return $this->value instanceof PageComponentAuth0StructureSection && $this->type === 'page:component:auth0:structure:section';
    }

    /**
     * @return PageComponentAuth0StructureSection
     */
    public function asPageComponentAuth0StructureSection(): PageComponentAuth0StructureSection
    {
        if (!($this->value instanceof PageComponentAuth0StructureSection && $this->type === 'page:component:auth0:structure:section')) {
            throw new Exception(
                "Expected page:component:auth0:structure:section; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0StructureSeparator(): bool
    {
        return $this->value instanceof PageComponentAuth0StructureSeparator && $this->type === 'page:component:auth0:structure:separator';
    }

    /**
     * @return PageComponentAuth0StructureSeparator
     */
    public function asPageComponentAuth0StructureSeparator(): PageComponentAuth0StructureSeparator
    {
        if (!($this->value instanceof PageComponentAuth0StructureSeparator && $this->type === 'page:component:auth0:structure:separator')) {
            throw new Exception(
                "Expected page:component:auth0:structure:separator; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0MyOrganizationDomainTable(): bool
    {
        return $this->value instanceof PageComponentAuth0MyOrganizationDomainTable && $this->type === 'page:component:auth0:my_organization:domain_table';
    }

    /**
     * @return PageComponentAuth0MyOrganizationDomainTable
     */
    public function asPageComponentAuth0MyOrganizationDomainTable(): PageComponentAuth0MyOrganizationDomainTable
    {
        if (!($this->value instanceof PageComponentAuth0MyOrganizationDomainTable && $this->type === 'page:component:auth0:my_organization:domain_table')) {
            throw new Exception(
                "Expected page:component:auth0:my_organization:domain_table; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0MyOrganizationMemberManagement(): bool
    {
        return $this->value instanceof PageComponentAuth0MyOrganizationMemberManagement && $this->type === 'page:component:auth0:my_organization:member_management';
    }

    /**
     * @return PageComponentAuth0MyOrganizationMemberManagement
     */
    public function asPageComponentAuth0MyOrganizationMemberManagement(): PageComponentAuth0MyOrganizationMemberManagement
    {
        if (!($this->value instanceof PageComponentAuth0MyOrganizationMemberManagement && $this->type === 'page:component:auth0:my_organization:member_management')) {
            throw new Exception(
                "Expected page:component:auth0:my_organization:member_management; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0MyOrganizationDetailsEdit(): bool
    {
        return $this->value instanceof PageComponentAuth0MyOrganizationDetailsEdit && $this->type === 'page:component:auth0:my_organization:details_edit';
    }

    /**
     * @return PageComponentAuth0MyOrganizationDetailsEdit
     */
    public function asPageComponentAuth0MyOrganizationDetailsEdit(): PageComponentAuth0MyOrganizationDetailsEdit
    {
        if (!($this->value instanceof PageComponentAuth0MyOrganizationDetailsEdit && $this->type === 'page:component:auth0:my_organization:details_edit')) {
            throw new Exception(
                "Expected page:component:auth0:my_organization:details_edit; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0MyAccountPasskeyManagement(): bool
    {
        return $this->value instanceof PageComponentAuth0MyAccountPasskeyManagement && $this->type === 'page:component:auth0:my_account:passkey_management';
    }

    /**
     * @return PageComponentAuth0MyAccountPasskeyManagement
     */
    public function asPageComponentAuth0MyAccountPasskeyManagement(): PageComponentAuth0MyAccountPasskeyManagement
    {
        if (!($this->value instanceof PageComponentAuth0MyAccountPasskeyManagement && $this->type === 'page:component:auth0:my_account:passkey_management')) {
            throw new Exception(
                "Expected page:component:auth0:my_account:passkey_management; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isPageComponentAuth0MyAccountMfaManagement(): bool
    {
        return $this->value instanceof PageComponentAuth0MyAccountMfaManagement && $this->type === 'page:component:auth0:my_account:mfa_management';
    }

    /**
     * @return PageComponentAuth0MyAccountMfaManagement
     */
    public function asPageComponentAuth0MyAccountMfaManagement(): PageComponentAuth0MyAccountMfaManagement
    {
        if (!($this->value instanceof PageComponentAuth0MyAccountMfaManagement && $this->type === 'page:component:auth0:my_account:mfa_management')) {
            throw new Exception(
                "Expected page:component:auth0:my_account:mfa_management; got " . $this->type . " with value of type " . get_debug_type($this->value),
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
            case 'page:component:auth0:form':
                $value = $this->asPageComponentAuth0Form()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:typography:heading':
                $value = $this->asPageComponentAuth0TypographyHeading()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:media:image':
                $value = $this->asPageComponentAuth0MediaImage()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:typography:rich_text':
                $value = $this->asPageComponentAuth0TypographyRichText()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:structure:section':
                $value = $this->asPageComponentAuth0StructureSection()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:structure:separator':
                $value = $this->asPageComponentAuth0StructureSeparator()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:my_organization:domain_table':
                $value = $this->asPageComponentAuth0MyOrganizationDomainTable()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:my_organization:member_management':
                $value = $this->asPageComponentAuth0MyOrganizationMemberManagement()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:my_organization:details_edit':
                $value = $this->asPageComponentAuth0MyOrganizationDetailsEdit()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:my_account:passkey_management':
                $value = $this->asPageComponentAuth0MyAccountPasskeyManagement()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'page:component:auth0:my_account:mfa_management':
                $value = $this->asPageComponentAuth0MyAccountMfaManagement()->jsonSerialize();
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
            case 'page:component:auth0:form':
                $args['value'] = PageComponentAuth0Form::jsonDeserialize($data);
                break;
            case 'page:component:auth0:typography:heading':
                $args['value'] = PageComponentAuth0TypographyHeading::jsonDeserialize($data);
                break;
            case 'page:component:auth0:media:image':
                $args['value'] = PageComponentAuth0MediaImage::jsonDeserialize($data);
                break;
            case 'page:component:auth0:typography:rich_text':
                $args['value'] = PageComponentAuth0TypographyRichText::jsonDeserialize($data);
                break;
            case 'page:component:auth0:structure:section':
                $args['value'] = PageComponentAuth0StructureSection::jsonDeserialize($data);
                break;
            case 'page:component:auth0:structure:separator':
                $args['value'] = PageComponentAuth0StructureSeparator::jsonDeserialize($data);
                break;
            case 'page:component:auth0:my_organization:domain_table':
                $args['value'] = PageComponentAuth0MyOrganizationDomainTable::jsonDeserialize($data);
                break;
            case 'page:component:auth0:my_organization:member_management':
                $args['value'] = PageComponentAuth0MyOrganizationMemberManagement::jsonDeserialize($data);
                break;
            case 'page:component:auth0:my_organization:details_edit':
                $args['value'] = PageComponentAuth0MyOrganizationDetailsEdit::jsonDeserialize($data);
                break;
            case 'page:component:auth0:my_account:passkey_management':
                $args['value'] = PageComponentAuth0MyAccountPasskeyManagement::jsonDeserialize($data);
                break;
            case 'page:component:auth0:my_account:mfa_management':
                $args['value'] = PageComponentAuth0MyAccountMfaManagement::jsonDeserialize($data);
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
