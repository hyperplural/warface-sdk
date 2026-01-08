<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Tests;

use GuzzleHttp\Psr7\Response;
use Hyperplural\WarfaceSdk\Client;
use Hyperplural\WarfaceSdk\Exception\BadRequestException;
use Hyperplural\WarfaceSdk\Exception\InvalidApiEndpointException;
use PHPUnit\Framework\TestCase;

final class ExceptionTest extends TestCase
{
    public function testThrowsInvalidApiEndpointException(): void
    {
        $this->expectException(InvalidApiEndpointException::class);
        $this->expectExceptionMessage('Call unknown entity');

        // @phpstan-ignore-next-line calling unknown endpoint to trigger exception
        (new Client())->test();
    }

    public function testThrowsBadRequestUserNotFound(): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage('Пользователь не найден');

        $mock = new \Http\Mock\Client();
        $mock->addResponse(
            new Response(
                400,
                ['Content-Type' => 'application/json'],
                '{"message":"Пользователь не найден","code":400}'
            )
        );

        Client::createWithHttpClient($mock)->user()->stat('');
    }
}
