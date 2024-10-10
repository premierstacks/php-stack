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
