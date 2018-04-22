<?php

namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Exception\ClientException;

/**
 * Class EmailTemplateTest
 *
 * @package Auth0\Tests\API\Management
 */
class EmailTemplateTest extends ApiTests
{

    const EMAIL_TEMPLATE_NAME = 'enrollment_email';

    /**
     * Management API token with scopes read:email_templates, create:email_templates, update:email_templates
     *
     * @var string
     */
    protected static $token;

    /**
     * Valid tenant domain
     *
     * @var string
     */
    protected static $domain;

    /**
     * Auth0 v2 Management API accessor
     *
     * @var Management
     */
    protected static $api;

    /**
     * Email template retrieved during class setup, tested later
     *
     * @var array
     */
    protected static $gotEmail;

    /**
     * Can this email template be created?
     *
     * @var bool
     */
    protected static $mustCreate = false;

    /**
     * Test fixture for class
     *
     * @throws \Exception
     */
    public static function setUpBeforeClass()
    {
        $env = self::getEnvStatic();

        self::$domain = $env['DOMAIN'];
        self::$token = self::getTokenStatic($env, [
            'email_templates' => [
                'actions' => ['create', 'read', 'update']
            ]
        ]);

        self::$api = new Management(self::$token, self::$domain);

        try {
            self::$gotEmail = self::$api->emailTemplates->get(self::EMAIL_TEMPLATE_NAME);
        } catch (ClientException $e) {
            if (404 === $e->getCode()) {
                self::$mustCreate = true;
            }
        }
    }

    /**
     * Test fixture for each method
     */
    protected function assertPreConditions()
    {
        $this->assertNotEmpty(self::$token);
        $this->assertInstanceOf(Management::class, self::$api);
    }

    /**
     * @throws \Exception
     */
    public function testGotAnEmail()
    {
        if (self::$mustCreate) {
            self::$gotEmail = self::$api->emailTemplates->create([
                'template' => self::EMAIL_TEMPLATE_NAME,
                'body' => '<!doctype html><html><body><h1>Hi!</h1></body></html>',
                'from' => 'test@' . self::$domain,
                'subject' => 'Test email',
                'syntax' => 'liquid',
                'urlLifetimeInSeconds' => 0,
                'enabled' => false,
            ]);
        }

        $this->assertEquals(self::EMAIL_TEMPLATE_NAME, self::$gotEmail['template']);
    }

    /**
     * Test updating the email template
     *
     * @throws \Exception
     */
    public function testPatch()
    {
        $new_subject = 'Email subject ' . time();
        self::$gotEmail = self::$api->emailTemplates->patch(self::EMAIL_TEMPLATE_NAME, [
            'subject' => $new_subject,
        ]);

        $this->assertEquals($new_subject, self::$gotEmail['subject']);
    }
}
