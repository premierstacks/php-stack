<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * @license
 *
 * This software is the exclusive property of Tomáš Chochola, protected by copyright laws.
 * Although the source code may be accessible, it is not free for use without a valid license.
 * A valid license, obtainable through proper channels, is required for any software use.
 * For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.
 *
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 * The terms are subject to changes. Users are encouraged to review them periodically.
 *
 * @see {@link https://github.com/tomchochola} Personal GitHub
 * @see {@link https://github.com/premierstacks} Premierstacks GitHub
 * @see {@link https://github.com/sponsors/tomchochola} Sponsor & License
 * @see {@link https://premierstacks.com} Premierstacks website
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
