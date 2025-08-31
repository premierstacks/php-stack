<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025 Tomáš Chochola <chocholatom1997@gmail.com>
 *
 * @license CC-BY-ND-4.0
 *
 * @see {@link https://creativecommons.org/licenses/by-nd/4.0/} License
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
 */

declare(strict_types=1);

namespace Premierstacks\PhpStack\Http;

use Premierstacks\PhpStack\Debug\Errorf;
use Premierstacks\PhpStack\Types\Resources;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Client implements ClientInterface, RequestFactoryInterface, ResponseFactoryInterface, StreamFactoryInterface, UriFactoryInterface
{
    #[\Override]
    public function createRequest(string $method, mixed $uri): RequestInterface
    {
        if (!\is_string($uri) && !$uri instanceof UriInterface) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('uri', $uri, 'string|' . UriInterface::class));
        }

        return new Request($this->createStream(), '', $method, $uri instanceof UriInterface ? $uri : $this->createUri($uri), new HeaderBag(), '');
    }

    #[\Override]
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        if ($reasonPhrase === '') {
            $reasonPhrase = SymfonyResponse::$statusTexts[$code] ?? '';
        }

        return new Response($code, \is_string($reasonPhrase) ? $reasonPhrase : '', $this->createStream(), '', new HeaderBag());
    }

    #[\Override]
    public function createStream(string $content = ''): StreamInterface
    {
        $stream = new Stream(Resources::temp());

        $stream->write($content);

        return $stream;
    }

    #[\Override]
    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
        return new Stream(Resources::fopen($filename, $mode));
    }

    #[\Override]
    public function createStreamFromResource($resource): StreamInterface
    {
        return new Stream($resource);
    }

    #[\Override]
    public function createUri(string $uri = ''): UriInterface
    {
        return Uri::newFromString($uri);
    }

    #[\Override]
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $headers = [];

        foreach ($request->getHeaders() as $k => $v) {
            foreach ($v as $value) {
                $headers[] = "{$k}: {$value}";
            }
        }

        $method = $request->getMethod();

        if ($method === '') {
            $method = 'GET';
        }

        $protocol = $request->getProtocolVersion();

        if ($protocol === '') {
            $protocol = '1.1';
        }

        $context = \stream_context_create([
            'http' => [
                'method' => $method,
                'header' => $headers,
                'user_agent' => 'premierstacks/php-http-client',
                'content' => $request->getBody()->__toString(),
                'ignore_errors' => '1',
                'protocol_version' => $protocol,
            ],
        ]);

        $http_response_header = [];

        $response = \fopen($request->getUri()->__toString(), 'r', false, $context);

        if ($response === false) {
            throw new NetworkException($request, Errorf::unexpectedCallableError('\fopen', [$request->getUri()->__toString(), 'r', false, $context]));
        }

        $resource = $this->createStreamFromResource($response);

        if ($http_response_header === []) {
            $http_response_header = ['HTTP/1.1 200 OK'];
        }

        $parsed = \sscanf($http_response_header[0], " HTTP/ %f %d %[^\n]");

        $protocol = $parsed[0] ?? 1.1;
        $status = $parsed[1] ?? 200;
        $reason = $parsed[2] ?? SymfonyResponse::$statusTexts[$status] ?? '';

        if (!\is_string($reason)) {
            throw new \UnexpectedValueException(Errorf::unexpectedValue($reason, 'string'));
        }

        $headers = new HeaderBag();

        \array_splice($http_response_header, 0, 1);

        foreach ($http_response_header as $header) {
            $exploded = \explode(':', $header, 2);

            if (isset($exploded[0], $exploded[1])) {
                $headers->set(\mb_trim($exploded[0]), \mb_trim($exploded[1]), false);
            }
        }

        return new Response($status, \mb_trim($reason), $resource, (string) $protocol, $headers);
    }
}
