<?php

namespace Auth0\SDK\API\Management\Stats;

use Auth0\SDK\API\Management\Stats\Requests\GetDailyStatsRequestParameters;
use Auth0\SDK\API\Management\Types\DailyStats;

interface StatsClientInterface
{
    /**
     * Retrieve the number of active users that logged in during the last 30 days.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?float
     */
    public function getActiveUsersCount(?array $options = null): ?float;

    /**
     * Retrieve the number of logins, signups and breached-password detections (subscription required) that occurred each day within a specified date range.
     *
     * @param GetDailyStatsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<DailyStats>
     */
    public function getDaily(GetDailyStatsRequestParameters $request = new GetDailyStatsRequestParameters(), ?array $options = null): ?array;
}
