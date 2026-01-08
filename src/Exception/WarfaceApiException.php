<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Exception;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Hyperplural\WarfaceSdk\HttpClient\Message\ResponseMediator;
use Hyperplural\WarfaceSdk\HttpClient\Message\ResponseMediatorInterface;

class WarfaceApiException extends Exception
{
    public function __construct(string $message, int $statusCode = 0)
    {
        parent::__construct($message, $statusCode);
    }
}
