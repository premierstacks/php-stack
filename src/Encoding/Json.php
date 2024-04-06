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
 * The Proprietor: Tomáš Chochola
 * - Role: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 */

declare(strict_types=1);

namespace Tomchochola\PhpUtil\Encoding;

use Tomchochola\PhpUtil\Errors\Errorf;

class Json
{
    /**
     * @param positive-int $depth
     */
    public static function decode(string $json, bool|null $associative = null, int $depth = 512, int $flags = 0): mixed
    {
        $data = \json_decode($json, $associative, $depth, $flags);

        if (\json_last_error() !== \JSON_ERROR_NONE) {
            throw new \UnexpectedValueException(Errorf::errorReturnValue('json_decode', [$json, $associative, $depth, $flags], \json_last_error_msg()));
        }

        return $data;
    }

    /**
     * @param positive-int $depth
     *
     * @return non-empty-string
     */
    public static function encode(mixed $data, int $flags = 0, int $depth = 512): string
    {
        $json = \json_encode($data, $flags, $depth);

        if ($json === false) {
            throw new \UnexpectedValueException(Errorf::errorReturnValue('json_encode', [$data, $flags, $depth], \json_last_error_msg()));
        }

        return $json;
    }
}
