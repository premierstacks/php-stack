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

class JsonApiDocument implements JsonApiDocumentInterface
{
    /**
     * @param JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable<array-key, JsonApiResourceIdentifierInterface|JsonApiResourceInterface>|null $data
     * @param iterable<array-key, JsonApiErrorInterface>|null $errors
     * @param iterable<array-key, mixed>|null $meta
     * @param iterable<array-key, JsonApiLinkInterface|string>|null $links
     */
    public function __construct(
        public JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable|null $data = null,
        public iterable|null $errors = null,
        public iterable|null $meta = null,
        public iterable|null $links = null,
        public JsonApiInterface|null $jsonApi = null,
    ) {}

    #[\Override]
    public function getData(): JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable|null
    {
        return $this->data;
    }

    #[\Override]
    public function getErrors(): iterable|null
    {
        return $this->errors;
    }

    #[\Override]
    public function getJsonApi(): JsonApiInterface|null
    {
        return $this->jsonApi;
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
