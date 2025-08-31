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
