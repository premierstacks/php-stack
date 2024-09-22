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
