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

interface JsonApiErrorInterface
{
    public function getCode(): string|null;

    public function getDetail(): string|null;

    public function getId(): string|null;

    /**
     * @return iterable<array-key, JsonApiLinkInterface|string>|null
     */
    public function getLinks(): iterable|null;

    /**
     * @return iterable<array-key, mixed>|null
     */
    public function getMeta(): iterable|null;

    public function getSource(): JsonApiSourceInterface|null;

    public function getStatus(): string|null;

    public function getTitle(): string|null;
}
