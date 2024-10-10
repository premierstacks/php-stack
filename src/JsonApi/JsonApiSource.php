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

class JsonApiSource implements JsonApiSourceInterface
{
    public function __construct(public string|null $pointer = null, public string|null $header = null, public string|null $parameter = null) {}

    #[\Override]
    public function getHeader(): string|null
    {
        return $this->header;
    }

    #[\Override]
    public function getParameter(): string|null
    {
        return $this->parameter;
    }

    #[\Override]
    public function getPointer(): string|null
    {
        return $this->pointer;
    }
}
