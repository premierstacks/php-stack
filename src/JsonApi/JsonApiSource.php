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

class JsonApiSource implements JsonApiSourceInterface
{
    public function __construct(public string|null $pointer = null, public string|null $header = null, public string|null $parameter = null) {}

    #[\Override]
    public function getHeader(): string|null
    {
        return $this->header;
    }

    #[\Override]
    public function getParameter(): string|null
    {
        return $this->parameter;
    }

    #[\Override]
    public function getPointer(): string|null
    {
        return $this->pointer;
    }
}
