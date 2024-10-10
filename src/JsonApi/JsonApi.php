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
