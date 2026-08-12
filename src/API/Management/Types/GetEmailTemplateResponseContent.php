<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetEmailTemplateResponseContent extends JsonSerializableType
{
    /**
     * @var ?value-of<EmailTemplateNameEnum> $template
     */
    #[JsonProperty('template')]
    private ?string $template;

    /**
     * @var ?string $body Body of the email template.
     */
    #[JsonProperty('body')]
    private ?string $body;

    /**
     * @var ?string $from Senders `from` email address.
     */
    #[JsonProperty('from')]
    private ?string $from;

    /**
     * @var ?string $resultUrl URL to redirect the user to after a successful action.
     */
    #[JsonProperty('resultUrl')]
    private ?string $resultUrl;

    /**
     * @var ?string $subject Subject line of the email.
     */
    #[JsonProperty('subject')]
    private ?string $subject;

    /**
     * @var ?string $syntax Syntax of the template body.
     */
    #[JsonProperty('syntax')]
    private ?string $syntax;

    /**
     * @var ?float $urlLifetimeInSeconds Lifetime in seconds that the link within the email will be valid for.
     */
    #[JsonProperty('urlLifetimeInSeconds')]
    private ?float $urlLifetimeInSeconds;

    /**
     * @var ?bool $includeEmailInRedirect Whether the `reset_email` and `verify_email` templates should include the user's email address as the `email` parameter in the returnUrl (true) or whether no email address should be included in the redirect (false). Defaults to true.
     */
    #[JsonProperty('includeEmailInRedirect')]
    private ?bool $includeEmailInRedirect;

    /**
     * @var ?bool $enabled Whether the template is enabled (true) or disabled (false).
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @param array{
     *   template?: ?value-of<EmailTemplateNameEnum>,
     *   body?: ?string,
     *   from?: ?string,
     *   resultUrl?: ?string,
     *   subject?: ?string,
     *   syntax?: ?string,
     *   urlLifetimeInSeconds?: ?float,
     *   includeEmailInRedirect?: ?bool,
     *   enabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->template = $values['template'] ?? null;
        $this->body = $values['body'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->resultUrl = $values['resultUrl'] ?? null;
        $this->subject = $values['subject'] ?? null;
        $this->syntax = $values['syntax'] ?? null;
        $this->urlLifetimeInSeconds = $values['urlLifetimeInSeconds'] ?? null;
        $this->includeEmailInRedirect = $values['includeEmailInRedirect'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
    }

    /**
     * @return ?value-of<EmailTemplateNameEnum>
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param ?value-of<EmailTemplateNameEnum> $value
     */
    public function setTemplate(?string $value = null): self
    {
        $this->template = $value;
        $this->_setField('template');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param ?string $value
     */
    public function setBody(?string $value = null): self
    {
        $this->body = $value;
        $this->_setField('body');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getResultUrl(): ?string
    {
        return $this->resultUrl;
    }

    /**
     * @param ?string $value
     */
    public function setResultUrl(?string $value = null): self
    {
        $this->resultUrl = $value;
        $this->_setField('resultUrl');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param ?string $value
     */
    public function setSubject(?string $value = null): self
    {
        $this->subject = $value;
        $this->_setField('subject');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSyntax(): ?string
    {
        return $this->syntax;
    }

    /**
     * @param ?string $value
     */
    public function setSyntax(?string $value = null): self
    {
        $this->syntax = $value;
        $this->_setField('syntax');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getUrlLifetimeInSeconds(): ?float
    {
        return $this->urlLifetimeInSeconds;
    }

    /**
     * @param ?float $value
     */
    public function setUrlLifetimeInSeconds(?float $value = null): self
    {
        $this->urlLifetimeInSeconds = $value;
        $this->_setField('urlLifetimeInSeconds');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeEmailInRedirect(): ?bool
    {
        return $this->includeEmailInRedirect;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeEmailInRedirect(?bool $value = null): self
    {
        $this->includeEmailInRedirect = $value;
        $this->_setField('includeEmailInRedirect');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
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
