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
