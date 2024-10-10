<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2024–Present Tomáš Chochola <chocholatom1997@gmail.com>. All rights reserved.
 *
 * @license
 *
 * This software is proprietary and licensed under specific terms set by its owner.
 * Any form of access, use, or distribution requires a valid and active license.
 * For full licensing terms, refer to the LICENSE.md file accompanying this software.
 *
 * @see {@link https://premierstacks.com} Website
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
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
