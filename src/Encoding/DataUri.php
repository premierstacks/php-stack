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

namespace Premierstacks\PhpUtil\Encoding;

class DataUri
{
    /**
     * @return non-falsy-string
     */
    public static function encode(string $mime, string $data, bool $utf = false): string
    {
        if ($utf) {
            return 'data:' . $mime . ';charset=utf-8,' . \rawurlencode($data);
        }

        return 'data:' . $mime . ';base64,' . \base64_encode($data);
    }
}
