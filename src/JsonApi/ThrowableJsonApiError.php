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
