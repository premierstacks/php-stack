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
