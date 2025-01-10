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

final class NullJsonApiResource implements JsonApiResourceInterface, NullInterface
{
    #[\Override]
    public function getAttributes(): null
    {
        return null;
    }

    #[\Override]
    public function getId(): null
    {
        return null;
    }

    #[\Override]
    public function getLinks(): null
    {
        return null;
    }

    #[\Override]
    public function getMeta(): null
    {
        return null;
    }

    #[\Override]
    public function getRelationships(): null
    {
        return null;
    }

    #[\Override]
    public function getSlug(): null
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
