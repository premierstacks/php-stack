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
 * @implements \IteratorAggregate<array-key, JsonApiLinkInterface|string>
 */
class JsonApiLinks implements \IteratorAggregate
{
    /**
     * @var array<array-key, iterable<array-key, JsonApiLinkInterface|string>>
     */
    public array $linksCollection = [];

    /**
     * @param iterable<array-key, JsonApiLinkInterface|string> $links
     */
    public function __construct(iterable $links = [])
    {
        $this->linksCollection[] = $links;
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        foreach ($this->linksCollection as $links) {
            yield from $links;
        }
    }

    /**
     * @param iterable<array-key, JsonApiLinkInterface|string> $links
     *
     * @return $this
     */
    public function push(iterable $links): static
    {
        $this->linksCollection[] = $links;

        return $this;
    }
}
