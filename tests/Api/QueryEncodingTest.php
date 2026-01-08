<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Tests\Api;

use GuzzleHttp\Psr7\Response;
use Hyperplural\WarfaceSdk\Api\Rating;
use Hyperplural\WarfaceSdk\Enum\RatingLeague;
use Hyperplural\WarfaceSdk\Client;
use PHPUnit\Framework\TestCase;

final class QueryEncodingTest extends TestCase
{
    public function testQueryIsEncodedWithRfc3986(): void
    {
        $mock = new \Http\Mock\Client();
        $mock->addResponse(new Response(200, ['Content-Type' => 'application/json'], '[]'));

        $client = Client::createWithHttpClient($mock);
        $api = new Rating($client);
        $api->monthly('A B', RatingLeague::ELITE);

        $request = $mock->getRequests()[0];
        $this->assertStringContainsString('clan=A%20B', $request->getUri()->getQuery());
    }
}
