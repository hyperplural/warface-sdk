<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Api;

use Hyperplural\WarfaceSdk\Exception\WarfaceApiException;

interface GameInterface
{
    /**
     * This method returns detailed information about available missions and rewards for completing.
     *
     * @return array<string|int, mixed>
     * @throws WarfaceApiException
     */
    public function missions(): array;
}
