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
 * @implements \IteratorAggregate<array-key, mixed>
 */
class JsonApiAttributes implements \IteratorAggregate
{
    /**
     * @var array<array-key, iterable<array-key, mixed>>
     */
    public array $attributesCollection = [];

    /**
     * @param iterable<array-key, mixed> $attributes
     */
    public function __construct(iterable $attributes = [])
    {
        $this->attributesCollection[] = $attributes;
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        foreach ($this->attributesCollection as $attributes) {
            yield from $attributes;
        }
    }

    /**
     * @param iterable<array-key, mixed> $attributes
     *
     * @return $this
     */
    public function push(iterable $attributes): static
    {
        $this->attributesCollection[] = $attributes;

        return $this;
    }
}
