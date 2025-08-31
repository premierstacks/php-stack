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

/**
 * @implements \IteratorAggregate<array-key, JsonApiErrorInterface>
 */
class JsonApiErrors implements \IteratorAggregate
{
    /**
     * @var array<array-key, iterable<array-key, JsonApiErrorInterface>>
     */
    public array $errorsCollection = [];

    /**
     * @param iterable<array-key, JsonApiErrorInterface> $errors
     */
    public function __construct(iterable $errors = [])
    {
        $this->errorsCollection[] = $errors;
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        foreach ($this->errorsCollection as $errors) {
            yield from $errors;
        }
    }

    /**
     * @param iterable<array-key, JsonApiErrorInterface> $errors
     *
     * @return $this
     */
    public function push(iterable $errors): static
    {
        $this->errorsCollection[] = $errors;

        return $this;
    }
}
