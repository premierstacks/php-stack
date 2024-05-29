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
