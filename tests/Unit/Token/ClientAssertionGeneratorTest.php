<?php

declare(strict_types=1);

use Auth0\SDK\Exception\TokenException;
use Auth0\SDK\Token\ClientAssertionGenerator;
use Auth0\Tests\Utilities\TokenGenerator;

uses()->group('token', 'token.generator');

it('throws an error when an incompatible signing algorithm is provided', function(): void {
    $mockSigningKey = TokenGenerator::generateDsaKeyPair();

    ClientAssertionGenerator::create(
        domain: uniqid(),
        clientId: uniqid(),
        signingKey: $mockSigningKey['private'],
        signingAlgorithm: uniqid()
    );
})->throws(TokenException::class);
