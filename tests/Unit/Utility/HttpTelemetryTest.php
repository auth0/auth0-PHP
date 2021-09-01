<?php

declare(strict_types=1);

use Auth0\SDK\Auth0;
use Auth0\SDK\Utility\HttpTelemetry;

uses()->group('utility', 'utility.http_telemetry', 'networking');

beforeEach(function(): void {
    HttpTelemetry::reset();
});

test('setCorePackage() is assigned by default', function(): void {
    $header_data = HttpTelemetry::get();

    $this->assertArrayHasKey('name', $header_data);
    $this->assertArrayHasKey('version', $header_data);
    $this->assertArrayHasKey('env', $header_data);
    $this->assertArrayHasKey('php', $header_data['env']);

    expect($header_data['name'])->toEqual('auth0-php');
    expect($header_data['version'])->toEqual(Auth0::VERSION);
    expect($header_data['env']['php'])->toEqual(phpversion());
});

test('setCorePackage() restores default data correctly', function(): void {
    HttpTelemetry::setPackage('test_name', '1.2.3');
    $headers = HttpTelemetry::get();

    expect($headers)->toHaveCount(3);
    $this->assertArrayHasKey('name', $headers);
    expect($headers['name'])->toEqual('test_name');
    $this->assertArrayHasKey('version', $headers);
    expect($headers['version'])->toEqual('1.2.3');

    HttpTelemetry::setCorePackage();
    $header_data = HttpTelemetry::get();

    $this->assertArrayHasKey('name', $header_data);
    $this->assertArrayHasKey('version', $header_data);
    $this->assertArrayHasKey('env', $header_data);
    $this->assertArrayHasKey('php', $header_data['env']);

    expect($header_data['name'])->toEqual('auth0-php');
    expect($header_data['version'])->toEqual(Auth0::VERSION);
    expect($header_data['env']['php'])->toEqual(phpversion());
});

test('setPackage() assigns data correctly', function(): void {
    HttpTelemetry::setPackage('test_name', '1.2.3');
    $headers = HttpTelemetry::get();

    expect($headers)->toHaveCount(3);
    $this->assertArrayHasKey('name', $headers);
    expect($headers['name'])->toEqual('test_name');
    $this->assertArrayHasKey('version', $headers);
    expect($headers['version'])->toEqual('1.2.3');
});

test('setEnvProperty() assigns data correctly', function(): void {
    HttpTelemetry::setEnvProperty('test_env_name', '2.3.4');
    $headers = HttpTelemetry::get();

    $this->assertArrayHasKey('env', $headers);
    expect($headers['env'])->toHaveCount(2);
    $this->assertArrayHasKey('test_env_name', $headers['env']);
    expect($headers['env']['test_env_name'])->toEqual('2.3.4');

    HttpTelemetry::setEnvProperty('test_env_name', '3.4.5');
    $headers = HttpTelemetry::get();
    expect($headers['env']['test_env_name'])->toEqual('3.4.5');

    HttpTelemetry::setEnvProperty('test_env_name_2', '4.5.6');
    $headers = HttpTelemetry::get();
    expect($headers['env']['test_env_name_2'])->toEqual('4.5.6');
});

test('setEnvironmentData() assigns data correctly', function(): void {
    HttpTelemetry::setEnvironmentData([
        'test_env_name' => '2.3.4'
    ]);
    $headers = HttpTelemetry::get();

    $this->assertArrayHasKey('env', $headers);
    expect($headers['env'])->toHaveCount(1);
    $this->assertArrayHasKey('test_env_name', $headers['env']);
    expect($headers['env']['test_env_name'])->toEqual('2.3.4');

    HttpTelemetry::setEnvProperty('test_env_name', '3.4.5');
    $headers = HttpTelemetry::get();
    expect($headers['env']['test_env_name'])->toEqual('3.4.5');

    HttpTelemetry::setEnvProperty('test_env_name_2', '4.5.6');
    $headers = HttpTelemetry::get();
    expect($headers['env']['test_env_name_2'])->toEqual('4.5.6');
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
    expect($header_built)->toEqual(json_encode($header_data));
});
