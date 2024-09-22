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
