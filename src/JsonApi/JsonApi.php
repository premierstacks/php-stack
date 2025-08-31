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

namespace Premierstacks\PhpStack\JsonApi;

class JsonApi implements JsonApiInterface
{
    /**
     * @param iterable<array-key, string>|null $ext
     * @param iterable<array-key, string>|null $profile
     * @param iterable<array-key, mixed>|null $meta
     */
    public function __construct(public string|null $version = null, public iterable|null $ext = null, public iterable|null $profile = null, public iterable|null $meta = null) {}

    #[\Override]
    public function getExt(): iterable|null
    {
        return $this->ext;
    }

    #[\Override]
    public function getMeta(): iterable|null
    {
        return $this->meta;
    }

    #[\Override]
    public function getProfile(): iterable|null
    {
        return $this->profile;
    }

    #[\Override]
    public function getVersion(): string|null
    {
        return $this->version;
    }
}
