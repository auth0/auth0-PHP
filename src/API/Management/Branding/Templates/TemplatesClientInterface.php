<?php

namespace Auth0\SDK\API\Management\Branding\Templates;

use Auth0\SDK\API\Management\Types\GetUniversalLoginTemplate;
use Auth0\SDK\API\Management\Types\UpdateUniversalLoginTemplateRequestContentTemplate;

interface TemplatesClientInterface
{
    /**
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    GetUniversalLoginTemplate
     *   |string
     * )|null
     */
    public function getUniversalLogin(?array $options = null): GetUniversalLoginTemplate|string|null;

    /**
     * Update the Universal Login branding template.
     *
     * <p>When <code>content-type</code> header is set to <code>application/json</code>:</p>
     * <pre>
     * {
     *   "template": "&lt;!DOCTYPE html&gt;{% assign resolved_dir = dir | default: "auto" %}&lt;html lang="{{locale}}" dir="{{resolved_dir}}"&gt;&lt;head&gt;{%- auth0:head -%}&lt;/head&gt;&lt;body class="_widget-auto-layout"&gt;{%- auth0:widget -%}&lt;/body&gt;&lt;/html&gt;"
     * }
     * </pre>
     *
     * <p>
     *   When <code>content-type</code> header is set to <code>text/html</code>:
     * </p>
     * <pre>
     * &lt!DOCTYPE html&gt;
     * {% assign resolved_dir = dir | default: "auto" %}
     * &lt;html lang="{{locale}}" dir="{{resolved_dir}}"&gt;
     *   &lt;head&gt;
     *     {%- auth0:head -%}
     *   &lt;/head&gt;
     *   &lt;body class="_widget-auto-layout"&gt;
     *     {%- auth0:widget -%}
     *   &lt;/body&gt;
     * &lt;/html&gt;
     * </pre>
     *
     * @param (
     *    string
     *   |UpdateUniversalLoginTemplateRequestContentTemplate
     * ) $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function updateUniversalLogin(string|UpdateUniversalLoginTemplateRequestContentTemplate $request, ?array $options = null): void;

    /**
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function deleteUniversalLogin(?array $options = null): void;
}
