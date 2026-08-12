<?php

namespace Auth0\SDK\API\Management\Guardian;

use Auth0\SDK\API\Management\Guardian\Enrollments\EnrollmentsClient;
use Auth0\SDK\API\Management\Guardian\Factors\FactorsClient;
use Auth0\SDK\API\Management\Guardian\Policies\PoliciesClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Guardian\Enrollments\EnrollmentsClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\FactorsClientInterface;
use Auth0\SDK\API\Management\Guardian\Policies\PoliciesClientInterface;

class GuardianClient implements GuardianClientInterface
{
    /**
     * @var EnrollmentsClient $enrollments
     */
    public EnrollmentsClient $enrollments;

    /**
     * @var FactorsClient $factors
     */
    public FactorsClient $factors;

    /**
     * @var PoliciesClient $policies
     */
    public PoliciesClient $policies;

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
        $this->enrollments = new EnrollmentsClient($this->client, $this->options);
        $this->factors = new FactorsClient($this->client, $this->options);
        $this->policies = new PoliciesClient($this->client, $this->options);
    }

    /**
     * @return EnrollmentsClientInterface
     */
    public function getEnrollments(): EnrollmentsClientInterface
    {
        return $this->enrollments;
    }

    /**
     * @return FactorsClientInterface
     */
    public function getFactors(): FactorsClientInterface
    {
        return $this->factors;
    }

    /**
     * @return PoliciesClientInterface
     */
    public function getPolicies(): PoliciesClientInterface
    {
        return $this->policies;
    }
}
