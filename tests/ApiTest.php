<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    /**
     * @return void
     */
    public function testApiGetProductsShouldReturnNotAuthorized(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/get_products');
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }
}
