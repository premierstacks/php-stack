<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025 Tomáš Chochola <chocholatom1997@gmail.com>
 *
 * @license CC-BY-ND-4.0
 *
 * @see {@link https://creativecommons.org/licenses/by-nd/4.0/} License
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
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
