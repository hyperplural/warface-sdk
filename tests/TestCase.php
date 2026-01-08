<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Tests;

use Hyperplural\WarfaceSdk\Api\AbstractApi;
use Hyperplural\WarfaceSdk\Client;
use Http\Mock\Client as MockHttpClient;
use GuzzleHttp\Psr7\Response;

use function array_rand;
use function file_get_contents;
use function is_string;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var class-string<AbstractApi>
     */
    protected string $apiClass;

    public function getApi(): AbstractApi
    {
        $client = new Client();

        return new $this->apiClass($client);
    }

    /**
     * Create API instance wired with a mock HTTP client that returns a single JSON fixture response.
     */
    protected function getApiWithFixture(string $fixtureRelativePath, int $status = 200): AbstractApi
    {
        $mock = new MockHttpClient();
        $body = file_get_contents(__DIR__ . '/fixtures/' . $fixtureRelativePath) ?: '';
        $mock->addResponse(new Response($status, ['Content-Type' => 'application/json'], $body));

        $client = Client::createWithHttpClient($mock);

        return new $this->apiClass($client);
    }

    /**
     * @param array<int, array<string, mixed>> $data
     * @return array<string, mixed>|null
     */
    /**
     * @template TValue
     * @param array<int, TValue> $data
     * @return TValue|null
     */
    protected function getRandomElement(array $data): mixed
    {
        if ($data === []) {
            return null;
        }

        return $data[array_rand($data)] ?? null;
    }
}
