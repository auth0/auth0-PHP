<?php
namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\SDK\API\Management\Clients;
use Auth0\Tests\API\BasicCrudTest;

/**
 * Class ClientsTest
 *
 * @package Auth0\Tests\API\Management
 */
class ClientsTest extends BasicCrudTest
{
    /**
     * Unique identifier name for Clients.
     *
     * @var string
     */
    protected $id_name = 'client_id';

    /**
     * Name of the created Client.
     * Appended with a random string in self::__construct().
     *
     * @var string
     */
    protected $create_client_name = 'TEST-CREATE-CLIENT-';

    /**
     * Application type of the created Client.
     *
     * @var string
     */
    protected $create_app_type = Clients::APP_TYPE_REGULAR_WEB;

    /**
     * SSO setting of the created Client.
     *
     * @var bool
     */
    protected $create_sso = false;

    /**
     * Description of the created Client.
     *
     * @var string
     */
    protected $create_desc = '__Auth0_PHP_initial_app_description__';

    /**
     * Name of the updated Client.
     * Appended with a random string in self::__construct().
     *
     * @var string
     */
    protected $update_client_name = 'TEST-UPDATE-CLIENT-';

    /**
     * Application type of the updated Client.
     *
     * @var string
     */
    protected $update_app_type = Clients::APP_TYPE_NON_INTERACTIVE;

    /**
     * SSO setting of the updated Client.
     *
     * @var bool
     */
    protected $update_sso = true;

    /**
     * Description of the updated Client.
     *
     * @var string
     */
    protected $update_desc = '__Auth0_PHP_updated_app_description__';

    /**
     * ClientsTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->create_client_name .= rand();
        $this->update_client_name .= rand();
    }

    /**
     * Return the ID for the entity created.
     *
     * @param array $entity - Client created during test.
     *
     * @return string|integer
     */
    protected function getId($entity)
    {
        return $entity[$this->id_name];
    }

    /**
     * Return the Clients API to test.
     *
     * @return Management\Clients
     */
    protected function getApiClient()
    {
        $token = $this->getToken($this->env, [ 'clients' => [ 'actions' => ['create', 'read', 'delete', 'update' ] ] ]);
        $api = new Management($token, $this->domain);
        return $api->clients;
    }

    /**
     * Get the Client create data to send with the test create call.
     *
     * @return array
     */
    protected function getCreateBody()
    {
        return [
            'name' => $this->create_client_name,
            'app_type' => $this->create_app_type,
            'sso' => $this->create_sso,
            'description' => $this->create_desc,
        ];
    }

    /**
     * Tests the \Auth0\SDK\API\Management\Clients::getAll() method.
     *
     * @param Management\Clients $client - API client to use.
     * @param array $created_entity - Entity created during create() test.
     *
     * @return mixed
     *
     * @throws \Exception
     */
    protected function getAll($client, $created_entity)
    {
        $fields = array_keys($this->getCreateBody());
        $fields[] = $this->id_name;

        // Check that pagination works.
        $all_results = $client->getAll($fields, true, $this->create_app_type, 1, 1);
        $this->assertEquals(1, count($all_results));
        $this->assertEquals(count($fields), count($all_results[0]));

        // If we want to check for the created result, we need all Clients.
        if ($this->findCreatedItem) {
            $all_results = $client->getAll($fields, true, $this->create_app_type, 0, 100);
        }

        return $all_results;
    }

    /**
     * Check that the Client created matches the initial values sent.
     *
     * @param array $entity - The created Client to check against initial values.
     */
    protected function afterCreate($entity)
    {
        $this->assertNotEmpty($entity[$this->id_name]);
        $this->assertEquals($this->create_client_name, $entity['name']);
        $this->assertEquals($this->create_app_type, $entity['app_type']);
        $this->assertEquals($this->create_sso, $entity['sso']);
        $this->assertEquals($this->create_desc, $entity['description']);
    }

    /**
     * Get the Client values that should be updated.
     *
     * @return array
     */
    protected function getUpdateBody()
    {
        return [
            'name' => $this->update_client_name,
            'app_type' => $this->update_app_type,
            'sso' => $this->update_sso,
            'description' => $this->update_desc,
        ];
    }

    /**
     * Update entity returned values check.
     *
     * @param array $entity - Client that was updated.
     */
    protected function afterUpdate($entity)
    {
        $this->assertEquals($this->update_client_name, $entity['name']);
        $this->assertEquals($this->update_app_type, $entity['app_type']);
        $this->assertEquals($this->update_sso, $entity['sso']);
        $this->assertEquals($this->update_desc, $entity['description']);
    }
}
