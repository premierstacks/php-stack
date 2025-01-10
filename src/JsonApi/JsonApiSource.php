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
