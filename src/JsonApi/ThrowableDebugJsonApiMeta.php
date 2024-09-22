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
