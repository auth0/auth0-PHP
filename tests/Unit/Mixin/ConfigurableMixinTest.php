<?php

declare(strict_types=1);

uses()->group('mixin', 'mixin.configurable');

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

    $configurable->getExample('123');
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALUE_REQUIRED, 'example'));

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

    $this->expectException(get_class($exception));

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

    $configurable->getMissing();
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_GET_MISSING, 'missing'));

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

    expect($configurable->getExample())->toEqual(123);
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
    expect($configurable->getExample())->toEqual(456);
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

    $configurable->setMissing(456);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_SET_MISSING, 'missing'));

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

    $configurable->setExample(null);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class);

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

    $configurable->setExample(123);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class);

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

    $configurable->setExample(123);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class);

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

    $configurable->setExample(123);

    expect($this->getExample())->toEqual('success');
})->throws(\Auth0\SDK\Exception\ConfigurationException::class);

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

    expect($configurable->getExample())->toBeNull();

    $configurable->pushExample('c');
    expect($configurable->getExample())->toEqual(['c']);
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
    expect($configurable->getExample())->toEqual(['a','b','c']);
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

    expect($configurable->pushExample([null]))->toEqual($configurable);
    expect($configurable->getExample())->toEqual(['a','b']);
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

    $configurable->pushMissing([123]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_GET_MISSING, 'missing'));

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

    expect($configurable->hasExample())->toBeFalse();
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

    $configurable->hasMissing();
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_GET_MISSING, 'missing'));

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

    $configurable->somethingSomething();
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_UNKNOWN_METHOD, 'somethingSomething'));

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

    $configurable->setExample(true);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_SET_IMMUTABLE);

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
    expect($configurable->getExample())->toEqual(123);
    $configurable->reset();
    expect($configurable->getExample())->toBeNull();
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

    $configurable->reset();
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_SET_IMMUTABLE);

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

    expect($configurable->getExample())->toEqual(123);
    expect($configurable->getExample2())->toEqual('test2');
    expect($configurable->getExample3())->toBeNull();
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

    expect($configurable->getExample())->toEqual(456);
    expect($configurable->getExample2())->toEqual('xyz');
    expect($configurable->getExample3())->toBeTrue();
});
