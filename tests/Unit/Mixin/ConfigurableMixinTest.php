<?php

declare(strict_types=1);

uses()->group('configuration', 'traits', 'mixins');

test('get() throws a ConfigurationException exception when a value is missing', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALUE_REQUIRED, 'example'));

    $configurable->getExample('123');
});

test('get() throws an exception when a value is missing', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $exception = new class() extends \Exception implements \Throwable {};

    $this->expectException($exception::class);

    $configurable->getExample($exception);
});


test('get() throws a ConfigurationException exception when a property is not defined', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_GET_MISSING, 'missing'));

    $configurable->getMissing();
});

test('get() returns a default value', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = 123
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->assertEquals(123, $configurable->getExample());
});

test('set() assigns a value', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = 123
        ) {
            $this->setState(func_get_args());
        }
    };

    $configurable->setExample(456);
    $this->assertEquals(456, $configurable->getExample());
});

test('set() throws an exception when a property does not exist', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = 123
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_SET_MISSING, 'missing'));

    $configurable->setMissing(456);
});

test('set() throws an exception when a non-nullable property is assigned a null value', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            int $example = 123
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);

    $configurable->setExample(null);
});

test('set() throws an exception when a property is assigned an invalid value type', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            string $example = 'hello world'
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);

    $configurable->setExample(123);
});

test('set() throws an exception when a nullable property is assigned an invalid value type', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?string $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);

    $configurable->setExample(123);
});

test('set() calls an onStateChange callback method on the parent class', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?string $example = null
        ) {
            $this->setState(func_get_args());
        }

        public function onStateChange(
            $propertyName,
            $propertyValue
        ) {
            return 'success';
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);

    $configurable->setExample(123);

    $this->assertEquals('success', $this->getExample());
});

test('push() adds to an array property value that has a nullable default value', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?array $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->assertNull($configurable->getExample());

    $configurable->pushExample('c');
    $this->assertEquals(['c'], $configurable->getExample());
});

test('push() adds to an array property value that has a default array value', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?array $example = ['a','b']
        ) {
            $this->setState(func_get_args());
        }
    };

    $configurable->pushExample('c');
    $this->assertEquals(['a','b','c'], $configurable->getExample());
});

test('push() without a value does not change the target property', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?array $example = ['a','b']
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->assertEquals($configurable, $configurable->pushExample([null]));
    $this->assertEquals(['a','b'], $configurable->getExample());
});

test('push() throws a ConfigurationException exception when a property is not defined', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_GET_MISSING, 'missing'));

    $configurable->pushMissing([123]);
});

test('has() returns false if a value was not defined', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->assertFalse($configurable->hasExample());
});

test('has() throws a ConfigurationException exception when a property is not defined', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_GET_MISSING, 'missing'));

    $configurable->hasMissing();
});

test('calling a non-existent method throws an ArgumentException', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_UNKNOWN_METHOD, 'somethingSomething'));

    $configurable->somethingSomething();
});

test('lock() causes a configuration to become immutable', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $configurable->lock();

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_SET_IMMUTABLE);

    $configurable->setExample(true);
});

test('reset() resets property values as expected', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $configurable->setExample(123);
    $this->assertEquals(123, $configurable->getExample());
    $configurable->reset();
    $this->assertNull($configurable->getExample());
});

test('reset() is not possible once lock() is used', function(): void {
    $configurable = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $configurable->lock();

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_SET_IMMUTABLE);

    $configurable->reset();
});

test('setState() will use a supplied configuration array, and values supplied this way overwrite passed arguments', function(): void {
    $class = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null,
            ?string $example2 = 'test',
            ?bool $example3 = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $configurable = new $class([
        'example' => 123,
        'example2' => 'test2'
    ], 456, 'xyz', true);

    $this->assertEquals(123, $configurable->getExample());
    $this->assertEquals('test2', $configurable->getExample2());
    $this->assertNull($configurable->getExample3());
});

test('setState() applies constructor values correctly', function(): void {
    $class = new class() {
        use \Auth0\SDK\Mixins\ConfigurableMixin;

        public function __construct(
            ?array $configuration = null,
            ?int $example = null,
            ?string $example2 = 'test',
            ?bool $example3 = null
        ) {
            $this->setState(func_get_args());
        }
    };

    $configurable = new $class(null, 456, 'xyz', true);

    $this->assertEquals(456, $configurable->getExample());
    $this->assertEquals('xyz', $configurable->getExample2());
    $this->assertTrue($configurable->getExample3());
});
