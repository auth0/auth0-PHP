<?php

namespace Auth0\Tests\API;

abstract class BasicCrudTest extends ApiTests {

    protected $domain;

    protected $findCreatedItem = true;

    protected abstract function getApiClient();
    protected abstract function getCreateBody();
    protected abstract function getUpdateBody();
    protected abstract function afterCreate($entity);
    protected abstract function afterUpdate($entity);

    protected function getAll($client, $entity) {
        return $client->getAll();
    }

    protected function getId($entity) {
        return $entity['id'];
    }

    public function testAll() {

        $client = $this->getApiClient();

        $options = $client->getApiClient()->get()->getGuzzleOptions();

        $this->assertArrayHasKey('base_uri', $options);
        $this->assertEquals("https://$this->domain/api/v2/", $options['base_uri']);

        $created = $client->create($this->getCreateBody());

        $all = $this->getAll($client, $created);

        $found = false;
        foreach ($all as $value) {
            if ($this->getId($value) === $this->getId($created)) {
                $found = true;
                break;
            }
        }

        if ($this->findCreatedItem) {
          $this->assertTrue($found, 'Created item not found');
        }

        $this->afterCreate($created);

        $client3 = $client->update($this->getId($created), $this->getUpdateBody());

        $get = $client->get($this->getId($created));
        $this->afterUpdate($get);

        $client->delete($this->getId($created));
    }
}