<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025, Tomáš Chochola <chocholatom1997@gmail.com>. Some rights reserved.
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

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\HttpFoundation\HeaderBag;

class Request extends Message implements RequestInterface
{
    public function __construct(
        public StreamInterface $stream,
        public string $protocolVersion,
        public string $method,
        public UriInterface $uri,
        HeaderBag $headers,
        public string $requestTarget,
    ) {
        parent::__construct($stream, $protocolVersion, $headers);
    }

    #[\Override]
    public function getMethod(): string
    {
        return $this->method;
    }

    #[\Override]
    public function getRequestTarget(): string
    {
        if ($this->requestTarget !== '') {
            return $this->requestTarget;
        }

        $target = $this->uri->getPath();

        if ($target === '') {
            $target = '/';
        }

        if ($this->uri->getQuery() !== '') {
            $target .= '?' . $this->uri->getQuery();
        }

        return $target;
    }

    #[\Override]
    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    #[\Override]
    public function withMethod(string $method): RequestInterface
    {
        $clone = clone $this;

        $clone->method = $method;

        return $clone;
    }

    #[\Override]
    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        $clone = clone $this;

        $clone->requestTarget = $requestTarget;

        return $clone;
    }

    #[\Override]
    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        $clone = clone $this;

        if ($preserveHost) {
            $uri = $uri->withHost($this->uri->getHost());
        }

        $clone->uri = $uri;

        return $clone;
    }
}
