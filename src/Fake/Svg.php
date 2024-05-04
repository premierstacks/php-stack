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
 * Tomáš Chochola: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 *
 * Premierstacks: The Organization
 * - GitHub: https://github.com/premierstacks
 */

declare(strict_types=1);

namespace Premierstacks\PhpUtil\Fake;

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
