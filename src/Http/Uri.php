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

use Premierstacks\PhpStack\Debug\Errorf;
use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    final public function __construct(
        public string $scheme = '',
        public string $user = '',
        public string|null $password = null,
        public string $host = '',
        public int|null $port = null,
        public string $path = '',
        public string $query = '',
        public string $fragment = '',
    ) {}

    #[\Override]
    public function __toString(): string
    {
        $uri = '';

        if ($this->scheme !== '') {
            $uri .= $this->scheme . ':';
        }

        $authority = $this->getAuthority();

        if ($authority !== '' || $this->scheme === 'file') {
            $uri .= '//' . $authority;
        }

        $path = $this->path;

        if ($authority !== '' && $path !== '') {
            $path = '/' . \ltrim($path, '/');
        }

        $uri .= $path;

        if ($this->query !== '') {
            $uri .= '?' . $this->query;
        }

        if ($this->fragment !== '') {
            $uri .= '#' . $this->fragment;
        }

        return $uri;
    }

    #[\Override]
    public function getAuthority(): string
    {
        $authority = '';

        if ($this->user !== '') {
            $authority .= $this->user;

            if ($this->password !== '') {
                $authority .= ':' . $this->password;
            }

            $authority .= '@';
        }

        $authority .= $this->host;

        if ($this->port !== null) {
            $authority .= ':' . $this->port;
        }

        return $authority;
    }

    #[\Override]
    public function getFragment(): string
    {
        return $this->fragment;
    }

    #[\Override]
    public function getHost(): string
    {
        return $this->host;
    }

    #[\Override]
    public function getPath(): string
    {
        return $this->path;
    }

    #[\Override]
    public function getPort(): int|null
    {
        $port = $this->port;

        if ($port === null) {
            return null;
        }

        return match (true) {
            $this->scheme === 'http' && $port === 80 => null,
            $this->scheme === 'https' && $port === 443 => null,
            default => $port,
        };
    }

    #[\Override]
    public function getQuery(): string
    {
        return $this->query;
    }

    #[\Override]
    public function getScheme(): string
    {
        return $this->scheme;
    }

    #[\Override]
    public function getUserInfo(): string
    {
        return $this->user . ($this->password !== '' ? ':' . $this->password : '');
    }

    /**
     * @param array<array-key, mixed>|object $query
     */
    public function mergeQuery(array|object $query): UriInterface
    {
        $old = $this->getQuery();
        $additional = \http_build_query($query);

        if ($additional === '') {
            return $this;
        }

        return $this->withQuery($old === '' ? $additional : $old . '&' . $additional);
    }

    #[\Override]
    public function withFragment(string $fragment): UriInterface
    {
        $clone = clone $this;

        $clone->fragment = $fragment;

        return $clone;
    }

    #[\Override]
    public function withHost(string $host): UriInterface
    {
        $clone = clone $this;

        $clone->host = $host;

        return $clone;
    }

    #[\Override]
    public function withPath(string $path): UriInterface
    {
        $clone = clone $this;

        $clone->path = $path;

        return $clone;
    }

    #[\Override]
    public function withPort(int|null $port): UriInterface
    {
        $clone = clone $this;

        $clone->port = $port;

        return $clone;
    }

    #[\Override]
    public function withQuery(string $query): UriInterface
    {
        $clone = clone $this;

        $clone->query = $query;

        return $clone;
    }

    #[\Override]
    public function withScheme(string $scheme): UriInterface
    {
        $clone = clone $this;

        $clone->scheme = $scheme;

        return $clone;
    }

    #[\Override]
    public function withUserInfo(string $user, string|null $password = null): UriInterface
    {
        $clone = clone $this;

        $clone->user = $user;
        $clone->password = $password;

        return $clone;
    }

    public static function newFromString(string $uri): static
    {
        $parsed = \parse_url($uri);

        if ($parsed === false) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('uri', $uri, 'URI'));
        }

        return new static($parsed['scheme'] ?? '', $parsed['user'] ?? '', $parsed['pass'] ?? null, $parsed['host'] ?? '', $parsed['port'] ?? null, $parsed['path'] ?? '', $parsed['query'] ?? '', $parsed['fragment'] ?? '');
    }
}
