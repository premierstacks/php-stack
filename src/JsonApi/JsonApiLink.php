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

class JsonApiLink implements JsonApiLinkInterface
{
    /**
     * @param iterable<array-key, string>|string|null $hreflang
     * @param iterable<array-key, mixed>|null $meta
     */
    public function __construct(
        public string|null $href = null,
        public string|null $rel = null,
        public JsonApiLinkInterface|string|null $describedby = null,
        public string|null $title = null,
        public string|null $type = null,
        public iterable|string|null $hreflang = null,
        public iterable|null $meta = null,
    ) {}

    #[\Override]
    public function getDescribedby(): JsonApiLinkInterface|string|null
    {
        return $this->describedby;
    }

    #[\Override]
    public function getHref(): string|null
    {
        return $this->href;
    }

    #[\Override]
    public function getHreflang(): iterable|string|null
    {
        return $this->hreflang;
    }

    #[\Override]
    public function getMeta(): iterable|null
    {
        return $this->meta;
    }

    #[\Override]
    public function getRel(): string|null
    {
        return $this->rel;
    }

    #[\Override]
    public function getTitle(): string|null
    {
        return $this->title;
    }

    #[\Override]
    public function getType(): string|null
    {
        return $this->type;
    }
}
