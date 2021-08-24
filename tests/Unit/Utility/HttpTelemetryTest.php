<?php

declare(strict_types=1);

use Auth0\SDK\Auth0;
use Auth0\SDK\Utility\HttpTelemetry;

uses()->group('networking', 'utility', 'utility.http_telemetry');

beforeEach(function(): void {
    HttpTelemetry::reset();
});

test('setCorePackage() is assigned by default', function(): void {
    $header_data = HttpTelemetry::get();

    $this->assertArrayHasKey('name', $header_data);
    $this->assertArrayHasKey('version', $header_data);
    $this->assertArrayHasKey('env', $header_data);
    $this->assertArrayHasKey('php', $header_data['env']);

    $this->assertEquals('auth0-php', $header_data['name']);
    $this->assertEquals(Auth0::VERSION, $header_data['version']);
    $this->assertEquals(phpversion(), $header_data['env']['php']);
});

test('setCorePackage() restores default data correctly', function(): void {
    HttpTelemetry::setPackage('test_name', '1.2.3');
    $headers = HttpTelemetry::get();

    $this->assertCount(3, $headers);
    $this->assertArrayHasKey('name', $headers);
    $this->assertEquals('test_name', $headers['name']);
    $this->assertArrayHasKey('version', $headers);
    $this->assertEquals('1.2.3', $headers['version']);

    HttpTelemetry::setCorePackage();
    $header_data = HttpTelemetry::get();

    $this->assertArrayHasKey('name', $header_data);
    $this->assertArrayHasKey('version', $header_data);
    $this->assertArrayHasKey('env', $header_data);
    $this->assertArrayHasKey('php', $header_data['env']);

    $this->assertEquals('auth0-php', $header_data['name']);
    $this->assertEquals(Auth0::VERSION, $header_data['version']);
    $this->assertEquals(phpversion(), $header_data['env']['php']);
});

test('setPackage() assigns data correctly', function(): void {
    HttpTelemetry::setPackage('test_name', '1.2.3');
    $headers = HttpTelemetry::get();

    $this->assertCount(3, $headers);
    $this->assertArrayHasKey('name', $headers);
    $this->assertEquals('test_name', $headers['name']);
    $this->assertArrayHasKey('version', $headers);
    $this->assertEquals('1.2.3', $headers['version']);
});

test('setEnvProperty() assigns data correctly', function(): void {
    HttpTelemetry::setEnvProperty('test_env_name', '2.3.4');
    $headers = HttpTelemetry::get();

    $this->assertArrayHasKey('env', $headers);
    $this->assertCount(2, $headers['env']);
    $this->assertArrayHasKey('test_env_name', $headers['env']);
    $this->assertEquals('2.3.4', $headers['env']['test_env_name']);

    HttpTelemetry::setEnvProperty('test_env_name', '3.4.5');
    $headers = HttpTelemetry::get();
    $this->assertEquals('3.4.5', $headers['env']['test_env_name']);

    HttpTelemetry::setEnvProperty('test_env_name_2', '4.5.6');
    $headers = HttpTelemetry::get();
    $this->assertEquals('4.5.6', $headers['env']['test_env_name_2']);
});

test('setEnvironmentData() assigns data correctly', function(): void {
    HttpTelemetry::setEnvironmentData([
        'test_env_name' => '2.3.4'
    ]);
    $headers = HttpTelemetry::get();

    $this->assertArrayHasKey('env', $headers);
    $this->assertCount(1, $headers['env']);
    $this->assertArrayHasKey('test_env_name', $headers['env']);
    $this->assertEquals('2.3.4', $headers['env']['test_env_name']);

    HttpTelemetry::setEnvProperty('test_env_name', '3.4.5');
    $headers = HttpTelemetry::get();
    $this->assertEquals('3.4.5', $headers['env']['test_env_name']);

    HttpTelemetry::setEnvProperty('test_env_name_2', '4.5.6');
    $headers = HttpTelemetry::get();
    $this->assertEquals('4.5.6', $headers['env']['test_env_name_2']);
});

test('build() creates the expected header structure', function(): void {
    $header_data = [
        'name' => 'test_name_2',
        'version' => '5.6.7',
        'env' => [
            'php' => PHP_VERSION,
            'test_env_name_3' => '6.7.8',
        ],
    ];

    HttpTelemetry::setPackage($header_data['name'], $header_data['version']);
    HttpTelemetry::setEnvProperty('test_env_name_3', '6.7.8');

    $header_built = base64_decode(HttpTelemetry::build());
    $this->assertEquals(json_encode($header_data), $header_built);
});
