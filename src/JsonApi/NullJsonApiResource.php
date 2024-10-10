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
