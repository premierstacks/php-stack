<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025, Tomáš Chochola <chocholatom1997@gmail.com>. Some rights reserved.
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

/**
 * @implements \IteratorAggregate<array-key, JsonApiRelationshipInterface>
 */
class JsonApiRelationships implements \IteratorAggregate
{
    /**
     * @var array<array-key, iterable<array-key, JsonApiRelationshipInterface>>
     */
    public array $relationshipsCollection = [];

    /**
     * @param iterable<array-key, JsonApiRelationshipInterface> $relationships
     */
    public function __construct(iterable $relationships = [])
    {
        $this->relationshipsCollection[] = $relationships;
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        foreach ($this->relationshipsCollection as $relationships) {
            yield from $relationships;
        }
    }

    /**
     * @param iterable<array-key, JsonApiRelationshipInterface> $relationships
     *
     * @return $this
     */
    public function push(iterable $relationships): static
    {
        $this->relationshipsCollection[] = $relationships;

        return $this;
    }
}
