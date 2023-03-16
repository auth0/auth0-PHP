<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Psr\Cache\CacheItemInterface;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Utility class for discovering and instantiating popular third-party libraries that implement a required interface.
 *
 * @internal This class is not intended for use by SDK consumers. API changes may occur unpredictably.
 * @codeCoverageIgnore
 */
final class InterfaceDiscovery
{
    private static array $customFactories = [];

    public const CONST_PSR18_PSR_MOCK_CLIENT = '\PsrMock\Psr18\Client';
    public const CONST_PSR17_PSR_MOCK_REQUEST_FACTORY = '\PsrMock\Psr17\RequestFactory';
    public const CONST_PSR17_PSR_MOCK_RESPONSE_FACTORY = '\PsrMock\Psr17\ResponseFactory';
    public const CONST_PSR17_PSR_MOCK_STREAM_FACTORY = '\PsrMock\Psr17\StreamFactory';
    public const CONST_PSR7_PSR_MOCK_REQUEST_MESSAGE = '\PsrMock\Psr7\Request';
    public const CONST_PSR7_PSR_MOCK_RESPONSE_MESSAGE = '\PsrMock\Psr7\Response';
    public const CONST_PSR7_PSR_MOCK_STREAM_MESSAGE = '\PsrMock\Psr7\Stream';
    public const CONST_PSR7_PSR_MOCK_URI_MESSAGE = '\PsrMock\Psr7\Uri';

    /**
     * Adds a custom factory to the discovery list for a given interface.
     *
     * @param string $interface The interface to add a factory for.
     * @param string $class The class name of the factory.
     * @param array<mixed> $arguments Arguments to pass to the factory when instantiating.
     *
     * @return static Returns the current FactoryDiscovery instance.
     */
    public static function inform(
        string $interface,
        string $class,
        array $arguments = []
    ): void {
        self::$customFactories[$interface] ??= [];
        self::$customFactories[$interface][$class] ??= [];
        self::$customFactories[$interface][$class][] = $arguments;
    }

    /**
     * Returns a PSR-18 HTTP Client, or null if one cannot be found.
     * These must implement the PSR-18 ClientInterface interface.
     *
     * Compatible providers: https://packagist.org/providers/psr/http-client-implementation
     *
     * @return ClientInterface|null A PSR-18 HTTP Client, or null if one cannot be found.
     */
    public static function getClient(): ?ClientInterface
    {
        return self::discover(ClientInterface::class, [
            // psr-mock/http-client-implementation 1.0+ is PSR-18 compatible.
            self::CONST_PSR18_PSR_MOCK_CLIENT => fn ($class = self::CONST_PSR18_PSR_MOCK_CLIENT) => new $class(),

            // guzzlehttp/guzzle 7.0+ is PSR-18 compatible.
            \GuzzleHttp\Client::class => fn () => new \GuzzleHttp\Client(),

            // symfony/http-client 4.3+ is PSR-18 compatible.
            \Symfony\Component\HttpClient\Psr18Client::class => fn () => new \Symfony\Component\HttpClient\Psr18Client(
                responseFactory: self::getResponseFactory(),
                streamFactory: self::getStreamFactory()
            ),

            // // php-http/guzzle6-adapter 2.0+ is PSR-18 compatible.
            // \Http\Adapter\Guzzle6\Client::class => fn () => new \Http\Adapter\Guzzle6\Client(
            //     client: new \GuzzleHttp\Client()
            // ),

            // // php-http/guzzle7-adapter 1.0+ is PSR-18 compatible.
            // \Http\Adapter\Guzzle7\Client::class => fn () => new \Http\Adapter\Guzzle7\Client(
            //     client: new \GuzzleHttp\Client()
            // ),

            // // php-http/curl-client 2.0+ is PSR-18 compatible.
            // \Http\Client\Curl::class => fn () => new \Http\Client\Curl\Client(
            //     responseFactory: self::getResponseFactory(),
            //     streamFactory: self::getStreamFactory()
            // ),

            // // kriswallsmith/buzz 1.0+ is PSR-18 compatible.
            // \Buzz\Client\FileGetContents::class => ['responseFactory' => self::getResponseFactory()],

            // // php-http/socket-client 2.0+ is PSR-18 compatible.
            // \Http\Client\Socket\Client::class => [self::getResponseFactory()],
            // // php-http/guzzle5-adapter 2.0+ is PSR-18 compatible.
            // \Http\Adapter\Guzzle5\Client::class => ['responseFactory' => self::getResponseFactory()],
            // // voku/httpful 0.2.20+ is PSR-18 compatible.
            // \Httpful\Client::class => [],
        ]);
    }

    /**
     * Returns a PSR-17 HTTP Response factory, or null if one cannot be found.
     * These must implement the PSR-17 ResponseFactoryInterface interface.
     *
     * Compatible libraries: https://packagist.org/providers/psr/http-factory-implementation
     *
     * @return ResponseFactoryInterface|null A PSR-17 HTTP Response factory, or null if one cannot be found.
     */
    public static function getResponseFactory(): ?ResponseFactoryInterface
    {
        return self::discover(ResponseFactoryInterface::class, [
            // psr-mock/http-factory-implementation 1.0+ is PSR-18 compatible.
            self::CONST_PSR17_PSR_MOCK_RESPONSE_FACTORY => fn ($class = self::CONST_PSR17_PSR_MOCK_RESPONSE_FACTORY) => new $class(),

            // nyholm/psr7 1.2+ is PSR-17 compatible.
            \Nyholm\Psr7\Factory\Psr17Factory::class => fn () => new \Nyholm\Psr7\Factory\Psr17Factory(),

            // guzzlehttp/psr7 1.6+ is PSR-17 compatible.
            \GuzzleHttp\Psr7\HttpFactory::class => fn () => new \GuzzleHttp\Psr7\HttpFactory(),

            // // zendframework/zend-diactoros 2.0+ is PSR-17 compatible. (Caution: Abandoned!)
            // \Zend\Diactoros\ResponseFactory::class => [],
            // // http-interop/http-factory-guzzle 1.0+ is PSR-17 compatible.
            // \Http\Factory\Guzzle\ResponseFactory::class => [],
            // // laminas/laminas-diactoros 2.0+ is PSR-17 compatible
            // \Laminas\Diactoros\ResponseFactory::class => [],
            // // slim/psr7 1.0+ is PSR-17 compatible.
            // \Slim\Psr7\Factory\ResponseFactory::class => [],
            // // typo3/core 10.0+ is PSR-17 compatible.
            // \TYPO3\CMS\Core\Http\ResponseFactory::class => [],
            // // nimbly/capsule 1.0+ is PSR-17 compatible.
            // \Nimbly\Capsule\Factory\ResponseFactory::class => [],
            // // httpsoft/http-message 1.0+ is PSR-17 compatible.
            // \HttpSoft\Message\ResponseFactory::class => [],
        ]);
    }

    /**
     * Returns a PSR-17 HTTP Request factory, or null if one cannot be found.
     * These must implement the PSR-17 ResponseFactoryInterface interface.
     *
     * Compatible libraries: https://packagist.org/providers/psr/http-factory-implementation
     *
     * @return RequestFactoryInterface|null A PSR-17 HTTP Request factory, or null if one cannot be found.
     */
    public static function getRequestFactory(): ?RequestFactoryInterface
    {
        return self::discover(RequestFactoryInterface::class, [
            // psr-mock/http-factory-implementation 1.0+ is PSR-18 compatible.
            self::CONST_PSR17_PSR_MOCK_REQUEST_FACTORY => fn ($class = self::CONST_PSR17_PSR_MOCK_REQUEST_FACTORY) => new $class(),

            // nyholm/psr7 1.2+ is PSR-17 compatible.
            \Nyholm\Psr7\Factory\Psr17Factory::class => fn () => new \Nyholm\Psr7\Factory\Psr17Factory(),

            // guzzlehttp/psr7 1.6+ is PSR-17 compatible.
            \GuzzleHttp\Psr7\HttpFactory::class => fn () => new \GuzzleHttp\Psr7\HttpFactory(),

            // // zendframework/zend-diactoros 2.0+ is PSR-17 compatible. (Caution: Abandoned!)
            // \Zend\Diactoros\RequestFactory::class => [],
            // // http-interop/http-factory-guzzle 1.0+ is PSR-17 compatible.
            // \Http\Factory\Guzzle\RequestFactory::class => [],
            // // laminas/laminas-diactoros 2.0+ is PSR-17 compatible
            // \Laminas\Diactoros\RequestFactory::class => [],
            // // slim/psr7 1.0+ is PSR-17 compatible.
            // \Slim\Psr7\Factory\RequestFactory::class => [],
            // // typo3/core 10.0+ is PSR-17 compatible.
            // \TYPO3\CMS\Core\Http\RequestFactory::class => [],
            // // nimbly/capsule 1.0+ is PSR-17 compatible.
            // \Nimbly\Capsule\Factory\RequestFactory::class => [],
            // // httpsoft/http-message 1.0+ is PSR-17 compatible.
            // \HttpSoft\Message\RequestFactory::class => [],
        ]);
    }

    /**
     * Returns a PSR-17 HTTP Stream factory, or null if one cannot be found.
     * These must implement the PSR-17 ResponseFactoryInterface interface.
     *
     * Compatible libraries: https://packagist.org/providers/psr/http-factory-implementation
     *
     * @return StreamFactoryInterface|null A PSR-17 HTTP Stream factory, or null if one cannot be found.
     */
    public static function getStreamFactory(): StreamFactoryInterface|null
    {
        return self::discover(StreamFactoryInterface::class, [
            // psr-mock/http-factory-implementation 1.0+ is PSR-18 compatible.
            self::CONST_PSR17_PSR_MOCK_STREAM_FACTORY => fn ($class = self::CONST_PSR17_PSR_MOCK_STREAM_FACTORY) => new $class(),

            // nyholm/psr7 1.2+ is PSR-17 compatible.
            \Nyholm\Psr7\Factory\Psr17Factory::class => fn () => new \Nyholm\Psr7\Factory\Psr17Factory(),

            // guzzlehttp/psr7 1.6+ is PSR-17 compatible.
            \GuzzleHttp\Psr7\HttpFactory::class => fn () => new \GuzzleHttp\Psr7\HttpFactory(),

            // // zendframework/zend-diactoros 2.0+ is PSR-17 compatible. (Caution: Abandoned!)
            // \Zend\Diactoros\StreamFactory::class => [],
            // // http-interop/http-factory-guzzle 1.0+ is PSR-17 compatible.
            // \Http\Factory\Guzzle\StreamFactory::class => [],
            // // laminas/laminas-diactoros 2.0+ is PSR-17 compatible
            // \Laminas\Diactoros\StreamFactory::class => [],
            // // slim/psr7 1.0+ is PSR-17 compatible.
            // \Slim\Psr7\Factory\StreamFactory::class => [],
            // // typo3/core 10.0+ is PSR-17 compatible.
            // \TYPO3\CMS\Core\Http\StreamFactory::class => [],
            // // nimbly/capsule 1.0+ is PSR-17 compatible.
            // \Nimbly\Capsule\Factory\StreamFactory::class => [],
            // // httpsoft/http-message 1.0+ is PSR-17 compatible.
            // \HttpSoft\Message\StreamFactory::class => [],
        ]);
    }

    /**
     * Returns a PSR-14 Event Dispatcher, or null if one cannot be found.
     * These must implement the PSR-14 EventDispatcherInterface interface.
     *
     * Compatible libraries: https://packagist.org/providers/psr/event-dispatcher-implementation
     *
     * @return EventDispatcherInterface|null A PSR-14 Event Dispatcher, or null if one cannot be found.
     */
    public static function getEventDispatcher(): EventDispatcherInterface|null
    {
        // Discovery list is ordered by popularity according to Packagist, with the most popular first.
        return self::discover(EventDispatcherInterface::class, [
            // MockPsr14EventDispatcher::class => fn () => new MockPsr14EventDispatcher(), // TODO Create a PSR14 mock.
            // // symfony/event-dispatcher 4.3+ is PSR-14 compatible.
            // \Symfony\Component\EventDispatcher\EventDispatcher::class => [],
            // // league/event 3.0+ is PSR-14 compatible.
            // \League\Event\EventDispatcher::class => [],
            // // yiisoft/event-dispatcher 1.0+ is PSR-14 compatible.
            // \Yiisoft\EventDispatcher\Dispatcher\Dispatcher::class => [],
            // // carlosas/simple-event-dispatcher 1.0+ is PSR-14 compatible.
            // \PHPAT\EventDispatcher\EventDispatcher::class => [],
        ]);
    }

    /**
     * Returns a PSR-11 Container, or null if one cannot be found.
     * These must implement the PSR-3 ContainerInterface interface.
     *
     * Compatible libraries: https://packagist.org/providers/psr/container-implementation
     *
     * @return ContainerInterface|null A PSR-11 Container, or null if one cannot be found.
     */
    public static function getContainer(): ContainerInterface|null
    {
        // Discovery list is ordered by popularity according to Packagist, with the most popular first.
        return self::discover(ContainerInterface::class, [
            // // symfony/dependency-injection 4.3+ is PSR-11 compatible.
            // \Symfony\Component\DependencyInjection\Container::class => [],
            // // league/container 3.0+ is PSR-11 compatible.
            // \League\Container\Container::class => [],
            // // yiisoft/di 3.0+ is PSR-11 compatible.
            // \Yiisoft\Di\Container::class => [],
            // // php-di/php-di 6.0+ is PSR-11 compatible.
            // \DI\Container::class => [],
            // // pimple/pimple 3.0+ is PSR-11 compatible.
            // \Pimple\Container::class => [],
        ]);
    }

    /**
     * Returns a PSR-6 Cache, or null if one cannot be found.
     * These must implement the PSR-6 CacheItemInterface interface.
     *
     * Compatible libraries: https://packagist.org/providers/psr/cache-implementation
     *
     * @return CacheItemInterface|null A PSR-6 Cache, or null if one cannot be found.
     */
    public static function getCache(): CacheItemInterface|null
    {
        // Discovery list is ordered by popularity according to Packagist, with the most popular first.
        return self::discover(CacheItemInterface::class, [
        ]);
    }

    /**
     * Returns a PSR-3 Logger, or null if one cannot be found.
     * These must implement the PSR-3 LoggerInterface interface.
     *
     * Compatible libraries: https://packagist.org/providers/psr/log-implementation
     *
     * @return LoggerInterface|null A PSR-3 Logger, or null if one cannot be found.
     */
    public static function getLogger(): LoggerInterface|null
    {
        // Discovery list is ordered by popularity according to Packagist, with the most popular first.
        return self::discover(LoggerInterface::class, [
            // // monolog/monolog 1.3+ is PSR-3 compatible.
            // \Monolog\Logger::class => [],
            // // graylog2/gelf-php 1.6+ is PSR-3 compatible.
            // \Gelf\Logger::class => [],
            // // laminas/laminas-log 2.0+ is PSR-3 compatible.
            // \Laminas\Log\Logger::class => [],
            // // google/cloud-logging 1.22.1+ is PSR-3 compatible.
            // \Google\Cloud\Logging\PsrLogger::class => [],
            // // cakephp/log 4.0+ is PSR-3 compatible.
            // \Cake\Log\Log::class => [],
        ]);
    }

    /**
     * Determine if $class exists and implements $interface. If so, create an instance of $class and return it. Otherwise, return null.
     *
     * @param string $interface The interface to discover
     * @param string $class     The class to instantiate
     * @param mixed  ...$args   Arguments to pass to the constructor
     *
     * @return ClientInterface|ResponseFactoryInterface|RequestFactoryInterface|StreamFactoryInterface|EventDispatcherInterface|null
     */
    private static function instance(
        string $interface,
        string $class,
        ?callable $constructor
    ): ClientInterface|ResponseFactoryInterface|RequestFactoryInterface|StreamFactoryInterface|EventDispatcherInterface|null {
        if (! class_exists($class)) {
            return null;
        }

        $interfaces = class_implements($class);

        if (! is_array($interfaces) || ! in_array($interface, $interfaces, true)) {
            return null;
        }

        try {
            return $constructor();
        } catch (\Throwable) {
        }

        return null;
    }

    /**
     * Discover an interface implementation from a list of well-known classes.
     *
     * @param string $interface        The interface to discover
     * @param array  $wellKnownClasses A list of well-known classes that implement the interface
     *
     * @return object|null The discovered implementation, or null if none could be found
     */
    private static function discover(string $interface, array $wellKnownClasses): object|null
    {
        $customFactories = [];

        if (isset(self::$customFactories[$interface])) {
            $customFactories = self::$customFactories[$interface];
        }

        $wellKnownClasses = array_merge($customFactories, $wellKnownClasses);

        foreach ($wellKnownClasses as $class => $constructor) {
            if (is_callable($constructor)) {
                $class = self::instance($interface, $class, $constructor);

                if (null !== $class) {
                    return $class;
                }
            }
        }

        return null;
    }
}
