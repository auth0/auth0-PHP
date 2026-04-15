<?php

namespace Auth0\SDK\API\Management\AttackProtection;

use Auth0\SDK\API\Management\AttackProtection\BotDetection\BotDetectionClient;
use Auth0\SDK\API\Management\AttackProtection\BreachedPasswordDetection\BreachedPasswordDetectionClient;
use Auth0\SDK\API\Management\AttackProtection\BruteForceProtection\BruteForceProtectionClient;
use Auth0\SDK\API\Management\AttackProtection\Captcha\CaptchaClient;
use Auth0\SDK\API\Management\AttackProtection\SuspiciousIpThrottling\SuspiciousIpThrottlingClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\AttackProtection\BotDetection\BotDetectionClientInterface;
use Auth0\SDK\API\Management\AttackProtection\BreachedPasswordDetection\BreachedPasswordDetectionClientInterface;
use Auth0\SDK\API\Management\AttackProtection\BruteForceProtection\BruteForceProtectionClientInterface;
use Auth0\SDK\API\Management\AttackProtection\Captcha\CaptchaClientInterface;
use Auth0\SDK\API\Management\AttackProtection\SuspiciousIpThrottling\SuspiciousIpThrottlingClientInterface;

class AttackProtectionClient implements AttackProtectionClientInterface
{
    /**
     * @var BotDetectionClient $botDetection
     */
    public BotDetectionClient $botDetection;

    /**
     * @var BreachedPasswordDetectionClient $breachedPasswordDetection
     */
    public BreachedPasswordDetectionClient $breachedPasswordDetection;

    /**
     * @var BruteForceProtectionClient $bruteForceProtection
     */
    public BruteForceProtectionClient $bruteForceProtection;

    /**
     * @var CaptchaClient $captcha
     */
    public CaptchaClient $captcha;

    /**
     * @var SuspiciousIpThrottlingClient $suspiciousIpThrottling
     */
    public SuspiciousIpThrottlingClient $suspiciousIpThrottling;

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
        $this->botDetection = new BotDetectionClient($this->client, $this->options);
        $this->breachedPasswordDetection = new BreachedPasswordDetectionClient($this->client, $this->options);
        $this->bruteForceProtection = new BruteForceProtectionClient($this->client, $this->options);
        $this->captcha = new CaptchaClient($this->client, $this->options);
        $this->suspiciousIpThrottling = new SuspiciousIpThrottlingClient($this->client, $this->options);
    }

    /**
     * @return BotDetectionClientInterface
     */
    public function getBotDetection(): BotDetectionClientInterface
    {
        return $this->botDetection;
    }

    /**
     * @return BreachedPasswordDetectionClientInterface
     */
    public function getBreachedPasswordDetection(): BreachedPasswordDetectionClientInterface
    {
        return $this->breachedPasswordDetection;
    }

    /**
     * @return BruteForceProtectionClientInterface
     */
    public function getBruteForceProtection(): BruteForceProtectionClientInterface
    {
        return $this->bruteForceProtection;
    }

    /**
     * @return CaptchaClientInterface
     */
    public function getCaptcha(): CaptchaClientInterface
    {
        return $this->captcha;
    }

    /**
     * @return SuspiciousIpThrottlingClientInterface
     */
    public function getSuspiciousIpThrottling(): SuspiciousIpThrottlingClientInterface
    {
        return $this->suspiciousIpThrottling;
    }
}
