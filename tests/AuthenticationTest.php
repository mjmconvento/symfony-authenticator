<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationTest extends WebTestCase
{
    /**
     * @param string $url
     * @param int $statusCode
     *
     * @return void
     *
     * @dataProvider redirectDataProvider
     */
    public function testShouldRedirectToLogin(string $url, int $statusCode): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    /**
     * @return array
     */
    public function redirectDataProvider(): array
    {
        return [
            [
                '/',
                302
            ],
            [
                '/secured_page',
                302
            ],
            [
                '/product/create',
                302
            ],
            [
                '/logout',
                302
            ],
        ];
    }

    /**
     *
     * @return void
     *
     * @dataProvider redirectDataProvider
     */
    public function testShouldHaveSuccessStatusForLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
