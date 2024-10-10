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

class JsonApiResourceIdentifier implements JsonApiResourceIdentifierInterface
{
    public function __construct(public string|null $id = null, public string|null $slug = null, public string|null $type = null) {}

    #[\Override]
    public function getId(): string|null
    {
        return $this->id;
    }

    #[\Override]
    public function getSlug(): string|null
    {
        return $this->slug;
    }

    #[\Override]
    public function getType(): string|null
    {
        return $this->type;
    }
}
