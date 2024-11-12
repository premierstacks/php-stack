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

namespace Premierstacks\PhpStack\Encoding;

use Premierstacks\PhpStack\Debug\Errorf;
use Premierstacks\PhpStack\Mixed\Assert;

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
     * @return array<array-key, mixed>
     */
    public static function decodeArray(string $json, int $depth = 512, int $flags = 0): array
    {
        $data = \json_decode($json, true, $depth, $flags);

        if (\json_last_error() !== \JSON_ERROR_NONE) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError('\json_decode', [$json, true, $depth, $flags], [], \json_last_error_msg()));
        }

        return Assert::array($data);
    }

    /**
     * @param positive-int $depth
     */
    public static function decodeObject(string $json, int $depth = 512, int $flags = 0): object
    {
        $data = \json_decode($json, false, $depth, $flags);

        if (\json_last_error() !== \JSON_ERROR_NONE) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError('\json_decode', [$json, false, $depth, $flags], [], \json_last_error_msg()));
        }

        return Assert::object($data);
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
