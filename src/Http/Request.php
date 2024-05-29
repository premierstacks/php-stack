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
 * 🤵 The Proprietor: Tomáš Chochola
 * - Role: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 * - Web: https://premierstacks.com
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
