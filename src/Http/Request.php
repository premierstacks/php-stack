<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * @license
 *
 * This software is proprietary property of Tomáš Chochola and protected by copyright laws.
 * A valid license is required for any use or manipulation of the software or source code.
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 *
 * @see {@link https://github.com/tomchochola} Personal GitHub
 * @see {@link https://premierstacks.com} Premierstacks website
 * @see {@link https://github.com/premierstacks} Premierstacks GitHub
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
