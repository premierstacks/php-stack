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

class ThrowableDebugJsonApiMeta extends JsonApiMeta
{
    public function __construct(public \Throwable $throwable)
    {
        parent::__construct();
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        yield from parent::getIterator();

        yield from $this->getThrowableDebugMeta();
    }

    /**
     * @return iterable<array-key, mixed>
     */
    public function getThrowableDebugMeta(): iterable
    {
        yield 'throwable' => [
            'message' => $this->throwable->getMessage(),
            'type' => $this->throwable::class,
            'file' => $this->throwable->getFile(),
            'line' => $this->throwable->getLine(),
            'trace' => $this->throwable->getTrace(),
        ];
    }
}
