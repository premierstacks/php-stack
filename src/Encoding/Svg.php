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
