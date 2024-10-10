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
use Premierstacks\PhpStack\IO\ResourceObject;

class Svg
{
    public static function encode(string $data, string $format = 'webp'): string
    {
        $resource = ResourceObject::newFromString();

        $imagick = new \Imagick();

        if ($imagick->readImageBlob($data) === false) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError($imagick::class . '->readImageBlob', [$data]));
        }

        if ($imagick->setImageFormat($format) === false) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError($imagick::class . '->setImageFormat', [$format]));
        }

        if ($imagick->writeImageFile($resource->resource) === false) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError($imagick::class . '->writeImageFile', [$resource->resource]));
        }

        if ($imagick->clear() === false) {
            throw new \UnexpectedValueException(Errorf::unexpectedCallableError($imagick::class . '->clear', []));
        }

        return $resource->streamGetContents(null, 0);
    }
}
