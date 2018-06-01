<?php
namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
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
     * Random number used for unique testing names.
     *
     * @var integer
     */
    protected $rand;

    /**
     * ClientsTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->rand = rand();
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
            'name' => 'TEST-CREATE-CLIENT-' . $this->rand,
            'app_type' => 'regular_web',
            'sso' => false,
            'description' => '__Auth0_PHP_initial_app_description__',
        ];
    }

    /**
     * Tests the \Auth0\SDK\API\Management\Clients::getAll() method.
     *
     * @param array $created_entity - Entity created during create() test.
     *
     * @return mixed
     *
     * @throws \Exception
     */
    protected function getAllEntities($created_entity)
    {
        $fields = array_keys($this->getCreateBody());
        $fields[] = $this->id_name;

        // Check that pagination works.
        $all_results = $this->api->getAll($fields, true, 1, 1);
        $this->assertEquals(1, count($all_results));
        $this->assertEquals(count($fields), count($all_results[0]));

        // If we want to check for the created result, we need all Clients.
        if ($this->findCreatedItem) {
            $all_results = $this->api->getAll($fields, true, 0, 100);
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
        $expect_client = $this->getCreateBody();
        $this->assertNotEmpty($entity[$this->id_name]);
        $this->assertEquals($expect_client['name'], $entity['name']);
        $this->assertEquals($expect_client['app_type'], $entity['app_type']);
        $this->assertEquals($expect_client['sso'], $entity['sso']);
        $this->assertEquals($expect_client['description'], $entity['description']);
    }

    /**
     * Get the Client values that should be updated.
     *
     * @return array
     */
    protected function getUpdateBody()
    {
        return [
            'name' => 'TEST-UPDATE-CLIENT-',
            'app_type' => 'native',
            'sso' => true,
            'description' => '__Auth0_PHP_updated_app_description__',
        ];
    }

    /**
     * Update entity returned values check.
     *
     * @param array $entity - Client that was updated.
     */
    protected function afterUpdate($entity)
    {
        $expect_client = $this->getUpdateBody();
        $this->assertEquals($expect_client['name'], $entity['name']);
        $this->assertEquals($expect_client['app_type'], $entity['app_type']);
        $this->assertEquals($expect_client['sso'], $entity['sso']);
        $this->assertEquals($expect_client['description'], $entity['description']);
    }
}
