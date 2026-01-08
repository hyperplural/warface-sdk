<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Api;

use Hyperplural\WarfaceSdk\Exception\WarfaceApiException;

interface ClanInterface
{
    /**
     * This method returns information about the clan.
     *
     * @return array<string|int, mixed>
     * @throws WarfaceApiException
     */
    public function members(string $clan): array;
}
