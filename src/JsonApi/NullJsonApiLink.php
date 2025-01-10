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

namespace Premierstacks\PhpStack\JsonApi;

final class NullJsonApiLink implements JsonApiLinkInterface, NullInterface
{
    #[\Override]
    public function getDescribedby(): null
    {
        return null;
    }

    #[\Override]
    public function getHref(): null
    {
        return null;
    }

    #[\Override]
    public function getHreflang(): null
    {
        return null;
    }

    #[\Override]
    public function getMeta(): null
    {
        return null;
    }

    #[\Override]
    public function getRel(): null
    {
        return null;
    }

    #[\Override]
    public function getTitle(): null
    {
        return null;
    }

    #[\Override]
    public function getType(): null
    {
        return null;
    }

    #[\Override]
    public function jsonSerialize(): null
    {
        return null;
    }
}
