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
 * Tomáš Chochola: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 *
 * Premierstacks: The Organization
 * - GitHub: https://github.com/premierstacks
 */

declare(strict_types=1);

namespace Premierstacks\PhpUtil\JsonApi;

class JsonApiError implements JsonApiErrorInterface
{
    /**
     * @param iterable<array-key, JsonApiLinkInterface|string>|null $links
     * @param iterable<array-key, mixed>|null $meta
     */
    public function __construct(
        public string|null $id = null,
        public iterable|null $links = null,
        public string|null $status = null,
        public string|null $code = null,
        public string|null $title = null,
        public string|null $detail = null,
        public JsonApiSourceInterface|null $source = null,
        public iterable|null $meta = null,
    ) {}

    #[\Override]
    public function getCode(): string|null
    {
        return $this->code;
    }

    #[\Override]
    public function getDetail(): string|null
    {
        return $this->detail;
    }

    #[\Override]
    public function getId(): string|null
    {
        return $this->id;
    }

    #[\Override]
    public function getLinks(): iterable|null
    {
        return $this->links;
    }

    #[\Override]
    public function getMeta(): iterable|null
    {
        return $this->meta;
    }

    #[\Override]
    public function getSource(): JsonApiSourceInterface|null
    {
        return $this->source;
    }

    #[\Override]
    public function getStatus(): string|null
    {
        return $this->status;
    }

    #[\Override]
    public function getTitle(): string|null
    {
        return $this->title;
    }
}
