<?php

namespace Auth0\SDK\API\Management\Experimentation;

use Auth0\SDK\API\Management\Experimentation\Experiments\ExperimentsClient;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\FeatureFlagsClient;
use Auth0\SDK\API\Management\Experimentation\Segments\SegmentsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Experimentation\Experiments\ExperimentsClientInterface;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\FeatureFlagsClientInterface;
use Auth0\SDK\API\Management\Experimentation\Segments\SegmentsClientInterface;

class ExperimentationClient implements ExperimentationClientInterface
{
    /**
     * @var ExperimentsClient $experiments
     */
    public ExperimentsClient $experiments;

    /**
     * @var FeatureFlagsClient $featureFlags
     */
    public FeatureFlagsClient $featureFlags;

    /**
     * @var SegmentsClient $segments
     */
    public SegmentsClient $segments;

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
        $this->featureFlags = new FeatureFlagsClient($this->client, $this->options);
        $this->segments = new SegmentsClient($this->client, $this->options);
    }

    /**
     * @return ExperimentsClientInterface
     */
    public function getExperiments(): ExperimentsClientInterface
    {
        return $this->experiments;
    }

    /**
     * @return FeatureFlagsClientInterface
     */
    public function getFeatureFlags(): FeatureFlagsClientInterface
    {
        return $this->featureFlags;
    }

    /**
     * @return SegmentsClientInterface
     */
    public function getSegments(): SegmentsClientInterface
    {
        return $this->segments;
    }
}
