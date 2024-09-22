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

namespace Premierstacks\PhpStack\Fake;

class Svg
{
    /**
     * @return non-falsy-string
     */
    public static function blank(int $width = 10, int $height = 10): string
    {
        return "<svg xmlns='http://www.w3.org/2000/svg' width='{$width}' height='{$height}' viewBox='0 0 {$width} {$height}'><rect width='100%' height='100%' fill='#000000'/></svg>";
    }

    /**
     * @return non-falsy-string
     */
    public static function placeholder(int $width = 800, int $height = 600): string
    {
        $content = "{$width}×{$height}";

        $h = $height / 2;
        $w = $width / \mb_strlen($content);

        $size = (int) \min($h, $w);

        return "<svg xmlns='http://www.w3.org/2000/svg' width='{$width}' height='{$height}' viewBox='0 0 {$width} {$height}'><rect width='100%' height='100%' fill='#DDDDDD'/><text x='50%' y='50%' font-family='Helvetica' font-size='{$size}px' fill='#999999' text-anchor='middle' dy='.15em'>{$content}</text></svg>";
    }
}
