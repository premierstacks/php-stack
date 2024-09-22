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
