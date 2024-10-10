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
