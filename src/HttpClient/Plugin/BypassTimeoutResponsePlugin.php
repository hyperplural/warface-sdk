<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\HttpClient\Plugin;

use Exception;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

use function bin2hex;
use function http_build_query;
use function is_string;
use function parse_str;
use function random_bytes;

/**
 * Later identical requests can lead to long responses or timeouts from the API.
 * This plugin appends a random suffix to the `name` query parameter to bypass that behavior.
 */
final class BypassTimeoutResponsePlugin implements Plugin
{
    /**
     * @throws Exception
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $uri = $request->getUri();

        $code = '<' . bin2hex(random_bytes(32));
        $params = [];

        parse_str($uri->getQuery(), $params);

        $params['name'] = isset($params['name']) && ($params['name'] !== [] && ($params['name'] !== '' && $params['name'] !== '0')) && is_string($params['name']) ? $params['name'] . $code : $code;
        $query = http_build_query($params, '', '&', PHP_QUERY_RFC3986);

        $request = $request->withUri($uri->withQuery($query));

        return $next($request);
    }
}
