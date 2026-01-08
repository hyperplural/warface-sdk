<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Api;

use Fig\Http\Message\RequestMethodInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Hyperplural\WarfaceSdk\Client;
use Hyperplural\WarfaceSdk\Enum\EntityList;
use Hyperplural\WarfaceSdk\Exception\ApiResponseErrorException;
use Hyperplural\WarfaceSdk\Exception\WarfaceApiException;
use Hyperplural\WarfaceSdk\HttpClient\Message\ResponseMediator;
use Hyperplural\WarfaceSdk\HttpClient\Message\ResponseMediatorInterface;

abstract class AbstractApi
{
    protected readonly Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    abstract protected function entity(): EntityList;

    /**
     * @param array<string, mixed> $params
     * @return array<string|int, mixed>
     * @throws WarfaceApiException
     */
    protected function getByMethod(string $method, array $params = []): array
    {
        $path = $this->entity()->value . '/' . $method;

        return $this->get($path, $params)->getBodyContentsDecode();
    }

    /**
     * @param array<string, mixed> $parameters
     * @throws WarfaceApiException
     */
    protected function get(string $path, array $parameters): ResponseMediatorInterface
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);
        }

        return $this->sendRequest(RequestMethodInterface::METHOD_GET, $path);
    }

    /**
     * @throws WarfaceApiException
     */
    private function sendRequest(string $method, string $uri): ResponseMediatorInterface
    {
        try {
            return new ResponseMediator(
                $this->client->getHttpClient()->send($method, $uri)
            );
        // Transport-level errors are turned into a domain exception.
        // @codeCoverageIgnoreStart
        } catch (ClientExceptionInterface $e) {
            throw new ApiResponseErrorException($e->getMessage(), $e->getCode());
        }
        // @codeCoverageIgnoreEnd
    }
}
