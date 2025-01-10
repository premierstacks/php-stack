<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025, Tomáš Chochola <chocholatom1997@gmail.com>. Some rights reserved.
 *
 * @license CC-BY-ND-4.0
 *
 * @see {@link https://creativecommons.org/licenses/by-nd/4.0/} License
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
 */

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Premierstacks\PhpStack\IO\ResourceObject;
use Premierstacks\PhpStack\Types\Resources;

$resource = new ResourceObject(Resources::temp());

$resource->fputcsv(['a', 'b', 'c']);
$resource->rewind();
$resource->fpassthru();
