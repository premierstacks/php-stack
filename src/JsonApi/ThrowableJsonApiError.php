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

class ThrowableJsonApiError extends JsonApiError
{
    public static string|null $defaultThrowableCode = '0';

    public static string|null $defaultThrowableStatus = '500';

    public function __construct(public \Throwable $throwable)
    {
        parent::__construct();
    }

    #[\Override]
    public function getCode(): string|null
    {
        return parent::getCode() ?? $this->getThrowableCode();
    }

    /**
     * @return iterable<array-key, mixed>
     */
    #[\Override]
    public function getMeta(): iterable
    {
        yield from parent::getMeta() ?? [];
    }

    #[\Override]
    public function getStatus(): string|null
    {
        return parent::getStatus() ?? $this->getThrowableStatus();
    }

    public function getThrowableCode(): string|null
    {
        $code = $this->throwable->getCode();

        if (\is_numeric($code)) {
            return (string) (int) $code;
        }

        return static::$defaultThrowableCode;
    }

    public function getThrowableStatus(): string|null
    {
        return static::$defaultThrowableStatus;
    }
}
