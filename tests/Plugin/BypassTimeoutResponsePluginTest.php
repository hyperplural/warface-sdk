<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Tests\Plugin;

use Hyperplural\WarfaceSdk\Client;
use Hyperplural\WarfaceSdk\Tests\TestCase;
use GuzzleHttp\Psr7\Response;

use function parse_str;

final class BypassTimeoutResponsePluginTest extends TestCase
{
    public function testAppendsRandomSuffixWhenNamePresent(): void
    {
        $this->apiClass = \Hyperplural\WarfaceSdk\Api\User::class;
        $mock = new \Http\Mock\Client();
        $mock->addResponse(new Response(200, ['Content-Type' => 'application/json'], '{}'));

        $client = Client::createWithHttpClient($mock);
        (new $this->apiClass($client))->stat('Nick');

        $requests = $mock->getRequests();
        $this->assertNotEmpty($requests);
        $query = $requests[0]->getUri()->getQuery();
        parse_str($query, $params);
        $this->assertArrayHasKey('name', $params);
        $this->assertIsString($params['name']);
        $this->assertTrue(str_starts_with($params['name'], 'Nick'));
        $this->assertGreaterThan(strlen('Nick'), strlen($params['name']));
    }

    public function testAddsNameWhenAbsent(): void
    {
        $this->apiClass = \Hyperplural\WarfaceSdk\Api\Game::class;
        $mock = new \Http\Mock\Client();
        $mock->addResponse(new Response(200, ['Content-Type' => 'application/json'], '[]'));

        $client = Client::createWithHttpClient($mock);
        (new $this->apiClass($client))->missions();

        $requests = $mock->getRequests();
        $this->assertNotEmpty($requests);
        $query = $requests[0]->getUri()->getQuery();
        parse_str($query, $params);
        $this->assertArrayHasKey('name', $params);
        $this->assertIsString($params['name']);
        $this->assertNotEmpty($params['name']);
    }
}
