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
