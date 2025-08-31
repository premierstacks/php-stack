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

class JsonApiResource implements JsonApiResourceInterface
{
    /**
     * @param iterable<array-key, mixed>|null $attributes
     * @param iterable<array-key, JsonApiRelationshipInterface>|null $relationships
     * @param iterable<array-key, JsonApiLinkInterface|string>|null $links
     * @param iterable<array-key, mixed>|null $meta
     */
    public function __construct(
        public string|null $id = null,
        public string|null $slug = null,
        public string|null $type = null,
        public iterable|null $attributes = null,
        public iterable|null $relationships = null,
        public iterable|null $links = null,
        public iterable|null $meta = null,
    ) {}

    #[\Override]
    public function getAttributes(): iterable|null
    {
        return $this->attributes;
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
    public function getRelationships(): iterable|null
    {
        return $this->relationships;
    }

    #[\Override]
    public function getSlug(): string|null
    {
        return $this->slug;
    }

    #[\Override]
    public function getType(): string|null
    {
        return $this->type;
    }
}
