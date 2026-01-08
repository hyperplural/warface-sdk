<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Tests\Api;

use Hyperplural\WarfaceSdk\Api\Clan;
use Hyperplural\WarfaceSdk\Tests\TestCase;

final class ClanTest extends TestCase
{
    public function testCanRequestClanMembers(): void
    {
        $this->apiClass = Clan::class;
        /** @var \Hyperplural\WarfaceSdk\Api\Clan $api */
        $api = $this->getApiWithFixture('clan/members.json');

        $clan = '1337';
        $element = $api->members($clan);

        $this->assertIsArray($element);
        $this->assertArrayHasKey('id', $element);
        $this->assertArrayHasKey('name', $element);
        $this->assertSame($clan, $element['name']);
        $this->assertArrayHasKey('members', $element);
    }
}
