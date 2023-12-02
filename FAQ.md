# Auth0 PHP SDK FAQ

- [What are PSRs?](#what-are-psrs)
- [HTTP Networking](#http-networking)
  - [How do PSR-18, PSR-17 and PSR-7 work together?](#how-do-psr-18-psr-17-and-psr-7-work-together)
  - [What is PSR-18?](#what-is-psr-18)
  - [What is PSR-17?](#what-is-psr-17)
  - [What is PSR-7?](#what-is-psr-7)
- [Events Dispatching](#events-dispatching)
  - [What is PSR-14?](#what-is-psr-14)
- [Caching](#caching)
  - [What is PSR-6?](#what-is-psr-6)

## What are PSRs?

PSR stands for PHP Standard Recommendation. It is a set of standards agreed upon by the developer community that improve interoperability between PHP packages by providing a set of common interfaces. The [PHP-FIG](https://www.php-fig.org/) (PHP Framework Interoperability Group) is responsible for maintaining these standards.

The Auth0 PHP SDK has been engineered to support all of these standards wherever possible to provide developers with maximum interoperability and flexibility.

In the interest of keeping the SDK as lightweight as possible, the SDK does not include any providers of the PSR implementations. Instead, the SDK requires developers to install the PSR implementations of their choice. This allows developers to choose the dependencies that best suit their needs.

# HTTP Networking

### How do PSR-18, PSR-17 and PSR-7 work together?

The PSR-18 Client will use the PSR-17 Factory to create the PSR-7 Message(s) that it sends.

- PSR-18 Clients are responsible for sending HTTP requests and returning HTTP responses.
- PSR-17 Factories are responsible for creating PSR-7 Messages.
- PSR-7 Messages are responsible for representing HTTP requests and responses.

### What is PSR-18?

[PSR-18 (HTTP Client)](https://www.php-fig.org/psr/psr-18/) is a standard that allows developers to plug in any HTTP client library of their choice for the SDK to deliver it's network requests through, as long as the client library implements the standard.

The Auth0 PHP SDK uses a provided PSR-18 Client to issue network requests to Auth0. These network requests and responses are represented as PSR-7 messages, which the Client creates using the configured PSR-17 Factory. (See next section.)

You can find a list of compatible libraries on [Packagist's PSR-18](https://packagist.org/providers/psr/http-client-implementation) page.

### What is PSR-17?

[PSR-17 (HTTP Factories)](https://www.php-fig.org/psr/psr-17/) is a standard that allows developers to plug in any HTTP message factory library of their choice for the SDK to use when creating HTTP requests and responses, as long as the factory library implements the standard.

The Auth0 PHP SDK uses a provided PSR-17 Factory to create PSR-7 Request and Response messages that represent network traffic to and from the Auth0 API. These are created using the PSR-7 implementation provided. (See next section.)

You can find a list of compatible libraries on [Packagist's PSR-17](https://packagist.org/providers/psr/http-factory-implementation) page.

### What is PSR-7?

[PSR-7 (HTTP Messages)](https://www.php-fig.org/psr/psr-7/) is a standard that allows developers to plug in any HTTP message library of their choice for the SDK to use when creating HTTP requests and responses, as long as the message library implements the standard.

The Auth0 PHP SDK uses the PSR-7 standard to create HTTP requests and responses. These requests and responses are sent to and received from the Auth0 API using the PSR-18 standard.

You can find a list of compatible libraries on [Packagist's PSR-7](https://packagist.org/providers/psr/http-message-implementation) page.

# Events Dispatching

## What is PSR-14?

[PSR-14 (Event Dispatcher)](https://www.php-fig.org/psr/psr-14/) is a standard that allows developers to plug in any event dispatcher library of their choice for the SDK to use when dispatching events, as long as the dispatcher library implements the standard.

The Auth0 PHP SDK uses the PSR-14 standard to dispatch events that can be listened for by developers' applications. These events are dispatched at various points throughout the SDK's execution, allowing developers to hook into the SDK's execution and perform custom actions.

You can find a list of compatible libraries on [Packagist's PSR-14](https://packagist.org/providers/psr/event-dispatcher-implementation) page.

# Caching

## What is PSR-6?

[PSR-6 (Caching Interface)](https://www.php-fig.org/psr/psr-6/) is a standard that allows developers to plug in any caching library of their choice for the SDK to use when caching data, as long as the caching library implements the standard.

The Auth0 PHP SDK uses the PSR-6 standard to cache data retrieved from the Auth0 API. This allows developers to improve the performance of their applications by reducing the number of requests made to the Auth0 API.

You can find a list of compatible libraries on [Packagist's PSR-6](https://packagist.org/providers/psr/cache-implementation) page.
