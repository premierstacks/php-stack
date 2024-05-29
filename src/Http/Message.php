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

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\HttpFoundation\HeaderBag;

class Message implements MessageInterface
{
    public function __construct(public StreamInterface $stream, public string $protocolVersion, public HeaderBag $headers) {}

    #[\Override]
    public function getBody(): StreamInterface
    {
        return $this->stream;
    }

    #[\Override]
    public function getHeader(string $name): array
    {
        return \array_filter($this->headers->all($name), 'is_string');
    }

    #[\Override]
    public function getHeaderLine(string $name): string
    {
        return \implode(', ', $this->headers->all($name));
    }

    #[\Override]
    public function getHeaders(): array
    {
        return \array_map(static fn(array $values): array => \array_filter($values, 'is_string'), $this->headers->all());
    }

    #[\Override]
    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }

    #[\Override]
    public function hasHeader(string $name): bool
    {
        return $this->headers->has($name);
    }

    #[\Override]
    public function withAddedHeader(string $name, $value): MessageInterface
    {
        $clone = clone $this;

        $clone->headers = clone $this->headers;
        $clone->headers->set($name, $value, false);

        return $clone;
    }

    #[\Override]
    public function withBody(StreamInterface $body): MessageInterface
    {
        $clone = clone $this;

        $clone->stream = $body;

        return $clone;
    }

    #[\Override]
    public function withHeader(string $name, $value): MessageInterface
    {
        $clone = clone $this;

        $clone->headers = clone $this->headers;
        $clone->headers->set($name, $value);

        return $clone;
    }

    #[\Override]
    public function withProtocolVersion(string $version): MessageInterface
    {
        $clone = clone $this;

        $clone->protocolVersion = $version;

        return $clone;
    }

    #[\Override]
    public function withoutHeader(string $name): MessageInterface
    {
        $clone = clone $this;

        $clone->headers = clone $this->headers;
        $clone->headers->remove($name);

        return $clone;
    }
}
