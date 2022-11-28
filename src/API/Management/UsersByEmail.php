<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\UsersByEmailInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class UsersByEmail.
 * Handles requests to the Users by Email endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Users_By_Email
 */
final class UsersByEmail extends ManagementEndpoint implements UsersByEmailInterface
{
    public function get(
        string $email,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$email] = Toolkit::filter([$email])->string()->trim();

        Toolkit::assert([
            [$email, \Auth0\SDK\Exception\ArgumentException::missing('email')],
        ])->isEmail();

        return $this->getHttpClient()->
            method('get')->
            addPath('users-by-email')->
            withParam('email', $email)->
            withOptions($options)->
            call();
    }
}
