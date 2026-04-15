<?php

namespace Auth0\SDK\API\Management\AttackProtection;

use Auth0\SDK\API\Management\AttackProtection\BotDetection\BotDetectionClientInterface;
use Auth0\SDK\API\Management\AttackProtection\BreachedPasswordDetection\BreachedPasswordDetectionClientInterface;
use Auth0\SDK\API\Management\AttackProtection\BruteForceProtection\BruteForceProtectionClientInterface;
use Auth0\SDK\API\Management\AttackProtection\Captcha\CaptchaClientInterface;
use Auth0\SDK\API\Management\AttackProtection\SuspiciousIpThrottling\SuspiciousIpThrottlingClientInterface;

interface AttackProtectionClientInterface
{
    /**
     * @return BotDetectionClientInterface
     */
    public function getBotDetection(): BotDetectionClientInterface;

    /**
     * @return BreachedPasswordDetectionClientInterface
     */
    public function getBreachedPasswordDetection(): BreachedPasswordDetectionClientInterface;

    /**
     * @return BruteForceProtectionClientInterface
     */
    public function getBruteForceProtection(): BruteForceProtectionClientInterface;

    /**
     * @return CaptchaClientInterface
     */
    public function getCaptcha(): CaptchaClientInterface;

    /**
     * @return SuspiciousIpThrottlingClientInterface
     */
    public function getSuspiciousIpThrottling(): SuspiciousIpThrottlingClientInterface;
}
