<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Api;

use Hyperplural\WarfaceSdk\Exception\WarfaceApiException;

interface AchievementInterface
{
    /**
     * This method returns a complete list of achievements available in the game, with their id and name.
     *
     * @return array<string|int, mixed>
     * @throws WarfaceApiException
     */
    public function catalog(): array;
}
