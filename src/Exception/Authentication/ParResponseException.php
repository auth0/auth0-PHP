<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception\Authentication;

use Auth0\SDK\Exception\ExtendedExceptionInterface;
use Exception;
use Psr\Http\Message\{RequestInterface, ResponseInterface};
use Throwable;

/**
 * The Pushed Authorization Request endpoint (`/oauth/par`) returned an unexpected response.
 *
 * @codeCoverageIgnore
 */
final class ParResponseException extends Exception implements ExtendedExceptionInterface
{
    public function __construct(
        ?string $message = null,
        int $code = 0,
        ?Throwable $previous = null,
        private ?ResponseInterface $response = null,
        private ?RequestInterface $request = null,
    ) {
        parent::__construct($message ?? self::message(), $code, $previous);
    }

    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    public function setRequest(RequestInterface $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function setResponse(ResponseInterface $response): self
    {
        $this->response = $response;

        return $this;
    }

    public static function message(
        array $values = [],
    ): string {
        return 'The Pushed Authorization Request endpoint (`/oauth/par`) returned an unexpected response.';
    }
}
