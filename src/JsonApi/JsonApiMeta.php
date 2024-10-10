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

/**
 * @implements \IteratorAggregate<array-key, mixed>
 */
class JsonApiMeta implements \IteratorAggregate
{
    /**
     * @var array<array-key, iterable<array-key, mixed>>
     */
    public array $metaCollection = [];

    /**
     * @param iterable<array-key, mixed> $meta
     */
    public function __construct(iterable $meta = [])
    {
        $this->metaCollection[] = $meta;
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        foreach ($this->metaCollection as $meta) {
            yield from $meta;
        }
    }

    /**
     * @param iterable<array-key, mixed> $meta
     *
     * @return $this
     */
    public function push(iterable $meta): static
    {
        $this->metaCollection[] = $meta;

        return $this;
    }
}
