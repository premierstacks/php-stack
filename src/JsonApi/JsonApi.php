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
