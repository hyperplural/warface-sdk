<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;

interface ResponseMediatorInterface
{
    public function getResponse(): ResponseInterface;

    /**
     * @return array<string|int, mixed>
     */
    public function getBodyContentsDecode(): array;
}
