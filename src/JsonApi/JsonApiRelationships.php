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
