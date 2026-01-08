<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Tests;

use Hyperplural\WarfaceSdk\Api\Achievement;
use Hyperplural\WarfaceSdk\Api\ClanInterface;
use Hyperplural\WarfaceSdk\Api\GameInterface;
use Hyperplural\WarfaceSdk\Api\RatingInterface;
use Hyperplural\WarfaceSdk\Api\UserInterface;
use Hyperplural\WarfaceSdk\Client;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    public function testGetsInstancesFromTheClient(): void
    {
        $client = new Client();

        $this->assertInstanceOf(Achievement::class, $client->achievement());
        $this->assertInstanceOf(ClanInterface::class, $client->clan());
        $this->assertInstanceOf(GameInterface::class, $client->game());
        $this->assertInstanceOf(RatingInterface::class, $client->rating());
        $this->assertInstanceOf(UserInterface::class, $client->user());
    }
}
