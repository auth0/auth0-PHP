<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Authentication;

use Auth0\SDK\API\Authentication;
use PHPUnit\Framework\TestCase;

class UrlBuildersTest extends TestCase
{
    public function testThatBasicAuthorizeLinkIsBuiltCorrectly(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $authorize_url = $api->getAuthorizationLink('code', 'https://example.com/cb');
        $authorize_url_parts = parse_url($authorize_url);

        $this->assertEquals('https', $authorize_url_parts['scheme']);
        $this->assertEquals('test-domain.auth0.com', $authorize_url_parts['host']);
        $this->assertEquals('/authorize', $authorize_url_parts['path']);

        $authorize_url_query = explode('&', $authorize_url_parts['query']);
        $this->assertContains('redirect_uri=https%3A%2F%2Fexample.com%2Fcb', $authorize_url_query);
        $this->assertContains('response_type=code', $authorize_url_query);
        $this->assertContains('client_id=__test_client_id__', $authorize_url_query);
        $this->assertStringNotContainsString('connection=', $authorize_url_parts['query']);
        $this->assertStringNotContainsString('state=', $authorize_url_parts['query']);

        // Telemetry should not be added to any browser URLs.
        $this->assertStringNotContainsString('auth0Client=', $authorize_url_parts['query']);
    }

    public function testThatAuthorizeLinkIncludesConnection(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $authorize_url = $api->getAuthorizationLink('code', 'https://example.com/cb', 'test-connection');
        $authorize_url_query = parse_url($authorize_url, PHP_URL_QUERY);
        $authorize_url_query = explode('&', $authorize_url_query);

        $this->assertContains('connection=test-connection', $authorize_url_query);
    }

    public function testThatAuthorizeLinkIncludesState(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $authorize_url = $api->getAuthorizationLink('code', 'https://example.com/cb', null, '__test_state__');
        $authorize_url_query = parse_url($authorize_url, PHP_URL_QUERY);
        $authorize_url_query = explode('&', $authorize_url_query);

        $this->assertContains('state=__test_state__', $authorize_url_query);
    }

    public function testThatAuthorizeLinkIncludesAdditionalParams(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $additional_params = ['param1' => 'value1'];
        $authorize_url = $api->getAuthorizationLink('code', 'https://example.com/cb', null, null, $additional_params);
        $authorize_url_query = parse_url($authorize_url, PHP_URL_QUERY);
        $authorize_url_query = explode('&', $authorize_url_query);

        $this->assertContains('param1=value1', $authorize_url_query);
    }

    public function testThatBasicLogoutLinkIsBuiltCorrectly(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $logout_link_parts = parse_url($api->getLogoutLink());

        $this->assertEquals('https', $logout_link_parts['scheme']);
        $this->assertEquals('test-domain.auth0.com', $logout_link_parts['host']);
        $this->assertEquals('/v2/logout', $logout_link_parts['path']);

        // Telemetry should not be added to browser URLs.
        // If a query is added in the future, change this to check that auth0Client is not present.
        $this->assertTrue(strlen($logout_link_parts['query']) === 0);
    }

    public function testThatReturnToLogoutLinkIsBuiltCorrectly(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $logout_link_query = parse_url($api->getLogoutLink('https://example.com/return-to'), PHP_URL_QUERY);
        $logout_link_query = explode('&', $logout_link_query);

        $this->assertContains('returnTo=https%3A%2F%2Fexample.com%2Freturn-to', $logout_link_query);
    }

    public function testThatClientIdLogoutLinkIsBuiltCorrectly(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $logout_link_query = parse_url($api->getLogoutLink(null, '__test_client_id__'), PHP_URL_QUERY);
        $logout_link_query = explode('&', $logout_link_query);

        $this->assertContains('client_id=__test_client_id__', $logout_link_query);
    }

    public function testThatFederatedLogoutLinkIsBuiltCorrectly(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $logout_link_query = parse_url($api->getLogoutLink(null, null, true), PHP_URL_QUERY);
        $logout_link_query = explode('&', $logout_link_query);

        $this->assertContains('federated=federated', $logout_link_query);
    }

    public function testThatSamlLinkIsBuiltProperly(): void
    {
        $api = new Authentication('test-domain.auth0.com', 'test-client-id-1');

        $this->assertEquals(
            'https://test-domain.auth0.com/samlp/test-client-id-1?connection=',
            $api->getSamlpLink()
        );

        $this->assertEquals(
            'https://test-domain.auth0.com/samlp/test-client-id-2?connection=',
            $api->getSamlpLink('test-client-id-2')
        );

        $this->assertEquals(
            'https://test-domain.auth0.com/samlp/test-client-id-3?connection=test-connection',
            $api->getSamlpLink('test-client-id-3', 'test-connection')
        );
    }

    public function testThatSamlMetadataLinkIsBuiltProperly(): void
    {
        $api = new Authentication('test-domain.auth0.com', 'test-client-id-1');

        $this->assertEquals(
            'https://test-domain.auth0.com/samlp/metadata/test-client-id-1',
            $api->getSamlpMetadataLink()
        );

        $this->assertEquals(
            'https://test-domain.auth0.com/samlp/metadata/test-client-id-2',
            $api->getSamlpMetadataLink('test-client-id-2')
        );
    }

    public function testThatWsFedLinkIsBuiltProperly(): void
    {
        $api = new Authentication('test-domain.auth0.com', 'test-client-id-1');

        $this->assertEquals(
            'https://test-domain.auth0.com/wsfed/test-client-id-1?',
            $api->getWsfedLink()
        );

        $this->assertEquals(
            'https://test-domain.auth0.com/wsfed/test-client-id-2?',
            $api->getWsfedLink('test-client-id-2')
        );

        $this->assertEquals(
            'https://test-domain.auth0.com/wsfed/test-client-id-3?wtrealm=test_wtrealm&whr=test_whr&wctx=test_wctx',
            $api->getWsfedLink(
                'test-client-id-3',
                [
                    'wtrealm' => 'test_wtrealm',
                    'whr' => 'test_whr',
                    'wctx' => 'test_wctx',
                ]
            )
        );
    }

    public function testThatWsFedMetadataLinkIsBuiltProperly(): void
    {
        $api = new Authentication('test-domain.auth0.com', 'test-client-id-1');

        $this->assertEquals(
            'https://test-domain.auth0.com/wsfed/FederationMetadata/2007-06/FederationMetadata.xml',
            $api->getWsfedMetadataLink()
        );
    }
}
