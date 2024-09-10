<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * @license
 *
 * This software is the exclusive property of Tomáš Chochola, protected by copyright laws.
 * Although the source code may be accessible, it is not free for use without a valid license.
 * A valid license, obtainable through proper channels, is required for any software use.
 * For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.
 *
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 * The terms are subject to changes. Users are encouraged to review them periodically.
 *
 * @see {@link https://github.com/tomchochola} Personal GitHub
 * @see {@link https://github.com/premierstacks} Premierstacks GitHub
 * @see {@link https://github.com/sponsors/tomchochola} Sponsor & License
 * @see {@link https://premierstacks.com} Premierstacks website
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
