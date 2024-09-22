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

namespace Premierstacks\PhpStack\Encoding;

use Premierstacks\PhpStack\Debug\Errorf;

class Json
{
    /**
     * @param positive-int $depth
     */
    public static function decode(string $json, bool|null $associative = null, int $depth = 512, int $flags = 0): mixed
    {
        $data = \json_decode($json, $associative, $depth, $flags);

        if (\json_last_error() !== \JSON_ERROR_NONE) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError('\json_decode', [$json, $associative, $depth, $flags], [], \json_last_error_msg()));
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
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError('\json_encode', [$data, $flags, $depth], [], \json_last_error_msg()));
        }

        return $json;
    }
}
