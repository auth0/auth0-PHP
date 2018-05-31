<?php

namespace Auth0\Tests\API;

abstract class BasicCrudTest extends ApiTests
{
    /**
     * Tenant domain for the test account.
     *
     * @var string
     */
    protected $domain;

    /**
     * Environment variables, generated in self::__construct().
     *
     * @var array
     */
    protected $env;

    /**
     * Should all results be searched for the created entity?
     *
     * @var bool
     */
    protected $findCreatedItem = true;

    /**
     * CRUD API client to test.
     *
     * @return mixed
     */
    abstract protected function getApiClient();

    /**
     * Data to use to create the test entity.
     *
     * @return array
     */
    abstract protected function getCreateBody();

    /**
     * Data to use to update the test entity.
     *
     * @return array
     */
    abstract protected function getUpdateBody();

    /**
     * Assertions for the created entity.
     *
     * @param array $created_entity - Created entity.
     *
     * @return mixed
     */
    abstract protected function afterCreate($created_entity);

    /**
     * Assertions for the updated entity.
     *
     * @param array $updated_entity - Updated entity.
     *
     * @return mixed
     */
    abstract protected function afterUpdate($updated_entity);

    /**
     * BasicCrudTest constructor.
     * Sets up environment and domain value.
     */
    public function __construct()
    {
        parent::__construct();
        $this->env = $this->getEnv();
        $this->domain = $this->env['DOMAIN'];
    }

    /**
     * Stub "get all entities" method.
     * Can be overridden by child classes for specific test cases.
     *
     * @param mixed $crud_api - API client from the child class
     * @param array $created_entity - Created entity.
     *
     * @return mixed
     */
    protected function getAll($crud_api, $created_entity)
    {
        return $crud_api->getAll();
    }

    /**
     * Get the unique identifier for the entity.
     *
     * @param array $entity - Entity array.
     *
     * @return mixed
     */
    protected function getId($entity)
    {
        return $entity['id'];
    }

    /**
     * All basic CRUD test assertions.
     */
    public function testAll()
    {

        // Get the API client from the child class.
        $crud_api = $this->getApiClient();

        // Get and check that our options have been set correctly.
        $options = $crud_api->getApiClient()->get()->getGuzzleOptions();
        $this->assertArrayHasKey('base_uri', $options);
        $this->assertEquals("https://$this->domain/api/v2/", $options['base_uri']);

        // Test a generic "create entity" method for this API client.
        $created_entity = $crud_api->create($this->getCreateBody());
        $created_entity_id = $this->getId($created_entity);
        $this->afterCreate($created_entity);

        // Test a generic "get entity" method.
        $got_entity = $crud_api->get($created_entity_id);
        $this->afterCreate($got_entity);

        // Test a generic "get all entities" method for this API client.
        $all_entities = $this->getAll($crud_api, $created_entity);

        // Look through our returned results for the created item, if indicated.
        if ($this->findCreatedItem && !empty($all_entities)) {
            $found = false;
            foreach ($all_entities as $value) {
                if ($this->getId($value) === $created_entity_id) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found, 'Created item not found');
        }

        // Test a generic "update entity" method for this API client.
        $updated_entity = $crud_api->update($created_entity_id, $this->getUpdateBody());
        $this->afterUpdate($updated_entity);

        // Test a generic "delete entity" method for this API client.
        $crud_api->delete($created_entity_id);
    }
}
