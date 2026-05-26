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
     * When `content-type` header is set to `application/json`:
     *
     * ```json
     * {
     *   "template": "<!DOCTYPE html>{% assign resolved_dir = dir | default: \"auto\" %}<html lang=\"{{locale}}\" dir=\"{{resolved_dir}}\"><head>{%- auth0:head -%}</head><body class=\"_widget-auto-layout\">{%- auth0:widget -%}</body></html>"
     * }
     * ```
     *
     * When `content-type` header is set to `text/html`:
     *
     * ```html
     * <!DOCTYPE html>
     * {% assign resolved_dir = dir | default: "auto" %}
     * <html lang="{{locale}}" dir="{{resolved_dir}}">
     *   <head>
     *     {%- auth0:head -%}
     *   </head>
     *   <body class="_widget-auto-layout">
     *     {%- auth0:widget -%}
     *   </body>
     * </html>
     * ```
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
