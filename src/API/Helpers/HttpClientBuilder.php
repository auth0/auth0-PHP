<?php

namespace Auth0\SDK\API\Helpers;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class HttpClientBuilder
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var HttpClient
     */
    private $pureHttpClient;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @param string     $endpoint
     * @param HttpClient $httpClient
     */
    public function __construct($endpoint, HttpClient $httpClient = null)
    {
        if (!preg_match('|https?://.+|sim', $endpoint)) {
            $endpoint = 'https://'.$endpoint;
        }
        $this->endpoint = rtrim($endpoint, '/');
        $this->pureHttpClient = $httpClient ?: HttpClientDiscovery::find();
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Build a configured HTTP client.
     *
     * @return HttpMethodsClient
     */
    public function buildHttpClient()
    {
        $pluginClient = new PluginClient($this->pureHttpClient, [
            new BaseUriPlugin(UriFactoryDiscovery::find()->createUri($this->endpoint)),
            new HeaderDefaultsPlugin(['Content-Type' => 'application/json']),
            new HeaderAppendPlugin($this->headers),
        ]);

        return new HttpMethodsClient($pluginClient, MessageFactoryDiscovery::find());
    }
}
