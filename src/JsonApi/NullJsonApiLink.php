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
