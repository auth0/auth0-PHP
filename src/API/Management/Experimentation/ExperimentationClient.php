<?php

namespace Auth0\SDK\API\Management\Experimentation;

use Auth0\SDK\API\Management\Experimentation\Experiments\ExperimentsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Experimentation\Experiments\ExperimentsClientInterface;

class ExperimentationClient implements ExperimentationClientInterface
{
    /**
     * @var ExperimentsClient $experiments
     */
    public ExperimentsClient $experiments;

    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
        $this->experiments = new ExperimentsClient($this->client, $this->options);
    }

    /**
     * @return ExperimentsClientInterface
     */
    public function getExperiments(): ExperimentsClientInterface
    {
        return $this->experiments;
    }
}
