<?php

/**
 * Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * This software is the exclusive property of Tomáš Chochola, protected by copyright laws.
 * Although the source code may be accessible, it is not free for use without a valid license.
 * A valid license, obtainable through proper channels, is required for any software use.
 * For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.
 *
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 * The terms are subject to changes. Users are encouraged to review them periodically.
 *
 * 🤵 The Proprietor: Tomáš Chochola
 * - Role: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 * - Web: https://premierstacks.com
 */

declare(strict_types=1);

namespace Premierstacks\PhpStack\JsonApi;

class JsonApiRelationship implements JsonApiRelationshipInterface
{
    /**
     * @param JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable<array-key, JsonApiResourceIdentifierInterface|JsonApiResourceInterface>|null $data
     * @param iterable<array-key, JsonApiLinkInterface|string>|null $links
     * @param iterable<array-key, mixed>|null $meta
     */
    public function __construct(public JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable|null $data = null, public iterable|null $links = null, public iterable|null $meta = null) {}

    #[\Override]
    public function getData(): JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable|null
    {
        return $this->data;
    }

    #[\Override]
    public function getLinks(): iterable|null
    {
        return $this->links;
    }

    #[\Override]
    public function getMeta(): iterable|null
    {
        return $this->meta;
    }
}
