<?php

declare(strict_types=1);

use Auth0\SDK\Exception\ConfigurationException;
use Auth0\Tests\Utilities\MockConfiguration;
use Auth0\Tests\Utilities\ObjectMutator;

uses()->group('configuration');

beforeEach(function(): void {
    $this->configuration = new MockConfiguration();
});

test('applyConfiguration() skips a null $configuration', function(): void {
    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'applyConfiguration',
        args: [null]
    );

    expect($response)->toBeInstanceOf(MockConfiguration::class);
    expect(class_uses($response))->toHaveKey('Auth0\SDK\Mixins\ConfigurableMixin');
    expect($response)->toEqual($this->configuration);
});

test('applyConfiguration() skips invalid properties', function(): void {
    $mockPropertyValue = uniqid();

    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'applyConfiguration',
        args: [
            'configuration' => [
                'validStringProperty' => $mockPropertyValue,
                'nonexistentProperty' => 123
            ]
        ]
    );

    expect($response)->toBeInstanceOf(MockConfiguration::class);
    expect(class_uses($response))->toHaveKey('Auth0\SDK\Mixins\ConfigurableMixin');
    expect($response)->toEqual($this->configuration);

    $propValid = ObjectMutator::getProperty($this->configuration, 'validStringProperty');
    $propNonexistent = false;

    expect($this->configuration->getValidStringProperty())->toEqual($mockPropertyValue);
    expect($propValid)->toEqual($mockPropertyValue);

    try {
        $propNonexistent = ObjectMutator::getProperty($this->configuration, 'nonexistentProperty');
    } catch (Throwable $th) {
        $propNonexistent = true;
    }

    expect($propNonexistent)->toBeTrue();
});

test('applyConfiguration() skips properties without configured defaults', function(): void {
    $mockPropertyValue = uniqid();

    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'applyConfiguration',
        args: [
            'configuration' => [
                'stringPropertyNoDefault' => 123
            ]
        ]
    );

    expect($response)->toBeInstanceOf(MockConfiguration::class);
    expect(class_uses($response))->toHaveKey('Auth0\SDK\Mixins\ConfigurableMixin');
    expect($response)->toEqual($this->configuration);

    $defaultNonexistent = false;

    try {
        $defaultNonexistent = $this->configuration->getStringPropertyNoDefault();
    } catch (Throwable $th) {
        $defaultNonexistent = true;
    }

    expect($defaultNonexistent)->toBeTrue();
});

test('applyConfiguration() throws a ConfigurationException when a validator for a configured property does not exist', function(): void {
    ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'applyConfiguration',
        args: [
            'configuration' => [
                'validStringProperty' => uniqid(),
                'stringPropertyNoValidator' => uniqid()
            ]
        ]
    );
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'stringPropertyNoValidator'));

test('applyConfiguration() assigns property values without a property setter', function(): void {
    $mockPropertyValue = uniqid();

    ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'applyConfiguration',
        args: [
            'configuration' => [
                'validStringProperty' => uniqid(),
                'stringPropertyNoSetter' => $mockPropertyValue
            ]
        ]
    );

    expect($this->configuration)
        ->toHaveProperty('stringPropertyNoSetter')
        ->stringPropertyNoSetter
            ->toEqual($mockPropertyValue);
});

test('filterArray() behaves as expected', function(): void {
    $mockArray = [
        'key1' => uniqid(),
        'key2' => uniqid(),
        'key3' => null,
        'key4' => uniqid(),
    ];

    $expectedMockArray = $mockArray;
    unset($expectedMockArray['key3']);

    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'filterArray',
        args: [
            'filtering' => $mockArray,
            'keepKeys' => true
        ]
    );

    expect($response)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(array_keys($expectedMockArray))
        ->toEqual($expectedMockArray);

    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'filterArray',
        args: [
            'filtering' => $mockArray,
            'keepKeys' => false
        ]
    );

    expect($response)
        ->toBeArray()
        ->toHaveCount(3)
        ->toEqual(array_values($expectedMockArray));
});

test('filterArrayMixed() behaves as expected', function(): void {
    $mockArray = [
        'key1' => 123,
        'key2' => null,
        'key3' => 'a string',
        'key4' => null,
        'key5' => (object) [
            'key5.1' => uniqid(),
            'key5.2' => null,
            'key5.3' => uniqid(),
        ],
        'key6' => true,
        'key7' => false,
        'key8' => 0,
        'key9' => -1,
    ];

    $expectedMockArray = $mockArray;
    unset($expectedMockArray['key2']);
    unset($expectedMockArray['key4']);

    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'filterArrayMixed',
        args: [
            'filtering' => []
        ]
    );

    expect($response)
        ->toBeNull();


    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'filterArrayMixed',
        args: [
            'filtering' => [null]
        ]
    );

    expect($response)
        ->toBeNull();

    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'filterArrayMixed',
        args: [
            'filtering' => $mockArray,
            'keepKeys' => true
        ]
    );

    expect($response)
        ->toBeArray()
        ->toHaveCount(7)
        ->toHaveKeys(array_keys($expectedMockArray))
        ->toEqual($expectedMockArray);

    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'filterArrayMixed',
        args: [
            'filtering' => $mockArray
        ]
    );

    expect($response)
        ->toBeArray()
        ->toHaveCount(7)
        ->toEqual(array_values($expectedMockArray));
});

test('filterDomain() behaves as expected', function(): void {
    $mock = 'https://?a=12&b=12.3.3.4:1233';

    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'filterDomain',
        args: [
            'domain' => $mock
        ]
    );

    expect($response)
        ->toBeNull();

    $mock = 'https://a.b.c';

    $response = ObjectMutator::callMethod(
        class: $this->configuration,
        method: 'filterDomain',
        args: [
            'domain' => $mock
        ]
    );

    expect($response)
        ->toBeNull();
});

test('filterString() behaves as expected', function(): void {
    $collection = explode("\n", trim(file_get_contents(__DIR__ . '/../../Data/XssTestCollection.txt')));
    $i = 0;

    foreach($collection as $test) {
        $i++;

        $response = ObjectMutator::callMethod(
            class: $this->configuration,
            method: 'filterString',
            args: [
                'string' => $test
            ]
        );

        expect($response)
            ->not()->toEqual($test);
    }
});
