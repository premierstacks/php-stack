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
