<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\EmailTemplatesInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class EmailTemplates.
 * Handles requests to the Email Templates endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Email_Templates
 */
final class EmailTemplates extends ManagementEndpoint implements EmailTemplatesInterface
{
    public function create(
        string $template,
        string $body,
        string $from,
        string $subject,
        string $syntax,
        bool $enabled,
        ?array $additional = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$template, $body, $from, $subject, $syntax] = Toolkit::filter([$template, $body, $from, $subject, $syntax])->string()->trim();
        [$additional] = Toolkit::filter([$additional])->array()->trim();

        Toolkit::assert([
            [$template, \Auth0\SDK\Exception\ArgumentException::missing('template')],
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
            [$from, \Auth0\SDK\Exception\ArgumentException::missing('from')],
            [$subject, \Auth0\SDK\Exception\ArgumentException::missing('subject')],
            [$syntax, \Auth0\SDK\Exception\ArgumentException::missing('syntax')],
        ])->isString();

        /* @var array<mixed> $additional */

        return $this->getHttpClient()->
            method('post')->
            addPath('email-templates')->
            withBody(
                (object) Toolkit::merge([
                    'template' => $template,
                    'body'     => $body,
                    'from'     => $from,
                    'subject'  => $subject,
                    'syntax'   => $syntax,
                    'enabled'  => $enabled,
                ], $additional),
            )->
            withOptions($options)->
            call();
    }

    public function get(
        string $templateName,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$templateName] = Toolkit::filter([$templateName])->string()->trim();

        Toolkit::assert([
            [$templateName, \Auth0\SDK\Exception\ArgumentException::missing('templateName')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('email-templates', $templateName)->
            withOptions($options)->
            call();
    }

    public function update(
        string $templateName,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$templateName] = Toolkit::filter([$templateName])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$templateName, \Auth0\SDK\Exception\ArgumentException::missing('templateName')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('put')->
            addPath('email-templates', $templateName)->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function patch(
        string $templateName,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$templateName] = Toolkit::filter([$templateName])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$templateName, \Auth0\SDK\Exception\ArgumentException::missing('templateName')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('patch')->
            addPath('email-templates', $templateName)->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }
}
