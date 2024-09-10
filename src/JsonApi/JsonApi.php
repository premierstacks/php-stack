<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * @license
 *
 * This software is the exclusive property of Tomáš Chochola, protected by copyright laws.
 * Although the source code may be accessible, it is not free for use without a valid license.
 * A valid license, obtainable through proper channels, is required for any software use.
 * For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.
 *
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 * The terms are subject to changes. Users are encouraged to review them periodically.
 *
 * @see {@link https://github.com/tomchochola} Personal GitHub
 * @see {@link https://github.com/premierstacks} Premierstacks GitHub
 * @see {@link https://github.com/sponsors/tomchochola} Sponsor & License
 * @see {@link https://premierstacks.com} Premierstacks website
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
