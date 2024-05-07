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
 * Tomáš Chochola: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 *
 * Premierstacks: The Organization
 * - GitHub: https://github.com/premierstacks
 */

declare(strict_types=1);

namespace Premierstacks\PhpUtil\JsonApi;

class JsonApi implements JsonApiInterface
{
    /**
     * @param iterable<array-key, string>|null $ext
     * @param iterable<array-key, string>|null $profile
     * @param iterable<array-key, mixed>|null $meta
     */
    public function __construct(public string|null $version = null, public iterable|null $ext = null, public iterable|null $profile = null, public iterable|null $meta = null) {}

    #[\Override]
    public function getExt(): iterable|null
    {
        return $this->ext;
    }

    #[\Override]
    public function getMeta(): iterable|null
    {
        return $this->meta;
    }

    #[\Override]
    public function getProfile(): iterable|null
    {
        return $this->profile;
    }

    #[\Override]
    public function getVersion(): string|null
    {
        return $this->version;
    }
}
