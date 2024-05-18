<?php

/**
 * Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * This software is the exclusive property of Tomáš Chochola, protected by copyright laws.
 * Although the source code may be accessible, it is not free for use without a valid license.
 * A valid license, obtainable through proper channels, is required for any software use.
 * For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.
 *
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 * The terms are subject to changes. Users are encouraged to review them periodically.
 *
 * Tomáš Chochola: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 *
 * Premierstacks: The Organization
 * - GitHub: https://github.com/premierstacks
 */

declare(strict_types=1);

namespace Premierstacks\PhpUtil\Http;

use Premierstacks\PhpUtil\Debug\Errorf;
use Premierstacks\PhpUtil\Types\Resources;
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
            [$k, $v] = \explode(':', $header, 2);

            $headers->set(\trim($k), \trim($v), false);
        }

        return new Response($status, \trim($reason), $resource, (string) $protocol, $headers);
    }
}
