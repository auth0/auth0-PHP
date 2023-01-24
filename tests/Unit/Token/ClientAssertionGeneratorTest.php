<?php

declare(strict_types=1);

use Auth0\SDK\Exception\TokenException;
use Auth0\SDK\Token;
use Auth0\SDK\Token\ClientAssertionGenerator;
use Auth0\SDK\Token\Generator;
use Auth0\Tests\Utilities\TokenGenerator;

uses()->group('token', 'token.generator');

it('throws an error when an incompatible signing algorithm is provided', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    ClientAssertionGenerator::create(
        domain: uniqid(),
        clientId: uniqid(),
        signingKey: $mockSigningKey['private'],
        signingAlgorithm: Token::ALGO_HS256
    );
})->throws(TokenException::class);

it('returns a properly configured of Generator instance', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = ClientAssertionGenerator::create(
        domain: uniqid(),
        clientId: uniqid(),
        signingKey: $mockSigningKey['private'],
        signingAlgorithm: Token::ALGO_RS256
    );

    expect($token)->toBeInstanceOf(Generator::class);
});
