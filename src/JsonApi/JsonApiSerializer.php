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

class JsonApiSerializer
{
    /**
     * @var array<string, object>
     */
    public array $included = [];

    public function detectStatus(object|null $document): int
    {
        if ($document === null) {
            return 204;
        }

        if (!\property_exists($document, 'errors') || !\is_iterable($document->errors) || $document->errors === []) {
            return 200;
        }

        $current = null;

        foreach ($document->errors as $error) {
            if (!\is_object($error) || !\property_exists($error, 'status') || !isset($error->status) || !\is_numeric($error->status)) {
                continue;
            }

            $status = (int) $error->status;

            if ($current === null) {
                $current = $status;
            } elseif ($status === $current) {
                continue;
            } elseif ($status < 500 && $current < 500) {
                $current = 400;
            } else {
                $current = 500;
            }
        }

        return $current ?? 500;
    }

    public function include(JsonApiResourceInterface $resource): void
    {
        if (isset($this->included["{$resource->getId()}:{$resource->getSlug()}"])) {
            return;
        }

        $serialized = $this->serializeResource($resource);

        if (
            $serialized === null
            || (!\property_exists($serialized, 'attributes') && !\property_exists($serialized, 'meta') && !\property_exists($serialized, 'links') && !\property_exists($serialized, 'relationships'))
        ) {
            return;
        }

        $this->included["{$resource->getId()}:{$resource->getSlug()}"] = $serialized;
    }

    public function serialize(JsonApiDocumentInterface $document): object|null
    {
        $serialized = \array_filter(
            [
                'data' => $this->serializeData($document->getData()),
                'errors' => $this->serializeErrors($document->getErrors()),
                'meta' => $this->serializeMeta($document->getMeta()),
                'links' => $this->serializeLinks($document->getLinks()),
                'jsonapi' => $this->serializeJsonApi($document->getJsonApi()),
            ],
            static fn(mixed $value): bool => $value !== null,
        );

        if ($serialized === [] || (!isset($serialized['data']) && !isset($serialized['errors']) && !isset($serialized['meta']))) {
            return null;
        }

        if ($this->included !== []) {
            $serialized['included'] = \array_values($this->included);
        }

        return (object) $serialized;
    }

    /**
     * @param iterable<array-key, mixed>|null $attributes
     */
    public function serializeAttributes(iterable|null $attributes): object|null
    {
        if ($attributes === null) {
            return null;
        }

        $serialized = \iterator_to_array($attributes);

        if ($serialized === []) {
            return null;
        }

        return (object) $serialized;
    }

    /**
     * @param JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable<array-key, JsonApiResourceIdentifierInterface|JsonApiResourceInterface>|null $data
     *
     * @return non-empty-list<object>|object|null
     */
    public function serializeData(JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable|null $data): array|object|null
    {
        if ($data === null) {
            return null;
        }

        if ($data instanceof JsonApiResourceInterface || $data instanceof JsonApiResourceIdentifierInterface) {
            return $this->serializeResource($data);
        }

        $serialized = [];

        foreach ($data as $resource) {
            $serializedResource = $this->serializeResource($resource);

            if ($serializedResource !== null) {
                $serialized[] = $serializedResource;
            }
        }

        if ($serialized === []) {
            return null;
        }

        return $serialized;
    }

    public function serializeError(JsonApiErrorInterface $error): object|null
    {
        $serialized = \array_filter(
            [
                'id' => $error->getId(),
                'links' => $this->serializeLinks($error->getLinks()),
                'status' => $error->getStatus(),
                'code' => $error->getCode(),
                'title' => $error->getTitle(),
                'detail' => $error->getDetail(),
                'source' => $this->serializeSource($error->getSource()),
                'meta' => $this->serializeMeta($error->getMeta()),
            ],
            static fn(mixed $value): bool => $value !== null,
        );

        if ($serialized === []) {
            return null;
        }

        return (object) $serialized;
    }

    /**
     * @param iterable<array-key, JsonApiErrorInterface>|null $errors
     *
     * @return non-empty-list<object>|null
     */
    public function serializeErrors(iterable|null $errors): array|null
    {
        if ($errors === null) {
            return null;
        }

        $serialized = [];

        foreach ($errors as $error) {
            $serializedError = $this->serializeError($error);

            if ($serializedError !== null) {
                $serialized[] = $serializedError;
            }
        }

        if ($serialized === []) {
            return null;
        }

        return $serialized;
    }

    /**
     * @param iterable<array-key, string>|null $ext
     *
     * @return non-empty-list<string>|null
     */
    public function serializeExt(iterable|null $ext): array|null
    {
        if ($ext === null) {
            return null;
        }

        $serialized = \iterator_to_array($ext, false);

        if ($serialized === []) {
            return null;
        }

        return $serialized;
    }

    /**
     * @param iterable<array-key, string>|string|null $hreflang
     *
     * @return non-empty-list<string>|string|null
     */
    public function serializeHreflang(iterable|string|null $hreflang): iterable|string|null
    {
        if ($hreflang === null) {
            return null;
        }

        if (\is_string($hreflang)) {
            return $hreflang;
        }

        $serialized = \iterator_to_array($hreflang, false);

        if ($serialized === []) {
            return null;
        }

        return $serialized;
    }

    public function serializeJsonApi(JsonApiInterface|null $jsonapi): object|null
    {
        if ($jsonapi === null) {
            return null;
        }

        $serialized = \array_filter(
            [
                'version' => $jsonapi->getVersion(),
                'ext' => $this->serializeExt($jsonapi->getExt()),
                'profile' => $this->serializeProfile($jsonapi->getProfile()),
                'meta' => $this->serializeMeta($jsonapi->getMeta()),
            ],
            static fn(mixed $value): bool => $value !== null,
        );

        if ($serialized === []) {
            return null;
        }

        return (object) $serialized;
    }

    public function serializeLink(JsonApiLinkInterface|string|null $link): object|string|null
    {
        if ($link === null) {
            return null;
        }

        if ($link instanceof NullInterface) {
            return $link;
        }

        if (\is_string($link)) {
            return $link;
        }

        $serialized = \array_filter(
            [
                'href' => $link->getHref(),
                'rel' => $link->getRel(),
                'describedby' => $this->serializeLink($link->getDescribedby()),
                'title' => $link->getTitle(),
                'type' => $link->getType(),
                'hreflang' => $this->serializeHreflang($link->getHreflang()),
                'meta' => $this->serializeMeta($link->getMeta()),
            ],
            static fn(mixed $value): bool => $value !== null,
        );

        if ($serialized === [] || !isset($serialized['href'])) {
            return null;
        }

        return (object) $serialized;
    }

    /**
     * @param JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable<array-key, JsonApiResourceIdentifierInterface|JsonApiResourceInterface>|null $linkage
     *
     * @return non-empty-list<object>|object|null
     */
    public function serializeLinkage(JsonApiResourceIdentifierInterface|JsonApiResourceInterface|iterable|null $linkage): array|object|null
    {
        if ($linkage === null) {
            return null;
        }

        if ($linkage instanceof JsonApiResourceInterface || $linkage instanceof JsonApiResourceIdentifierInterface) {
            return $this->serializeResourceIdentifier($linkage);
        }

        $serialized = [];

        foreach ($linkage as $resource) {
            $serializedResource = $this->serializeResourceIdentifier($resource);

            if ($serializedResource !== null) {
                $serialized[] = $serializedResource;
            }
        }

        if ($serialized === []) {
            return null;
        }

        return $serialized;
    }

    /**
     * @param iterable<array-key, JsonApiLinkInterface|string>|null $links
     */
    public function serializeLinks(iterable|null $links): object|null
    {
        if ($links === null) {
            return null;
        }

        $serialized = [];

        foreach ($links as $key => $link) {
            $serializedLink = $this->serializeLink($link);

            if ($serializedLink !== null) {
                $serialized[$key] = $serializedLink;
            }
        }

        if ($serialized === []) {
            return null;
        }

        return (object) $serialized;
    }

    /**
     * @param iterable<array-key, mixed>|null $meta
     */
    public function serializeMeta(iterable|null $meta): object|null
    {
        if ($meta === null) {
            return null;
        }

        $serialized = \iterator_to_array($meta);

        if ($serialized === []) {
            return null;
        }

        return (object) $serialized;
    }

    /**
     * @param iterable<array-key, string>|null $profile
     *
     * @return non-empty-list<string>|null
     */
    public function serializeProfile(iterable|null $profile): array|null
    {
        if ($profile === null) {
            return null;
        }

        $serialized = \iterator_to_array($profile, false);

        if ($serialized === []) {
            return null;
        }

        return $serialized;
    }

    public function serializeRelationship(JsonApiRelationshipInterface $relationship): object|null
    {
        $serialized = \array_filter(
            [
                'data' => $this->serializeLinkage($relationship->getData()),
                'links' => $this->serializeLinks($relationship->getLinks()),
                'meta' => $this->serializeMeta($relationship->getMeta()),
            ],
            static fn(mixed $value): bool => $value !== null,
        );

        if ($serialized === []) {
            return null;
        }

        return (object) $serialized;
    }

    /**
     * @param iterable<array-key, JsonApiRelationshipInterface>|null $relationships
     */
    public function serializeRelationships(iterable|null $relationships): object|null
    {
        if ($relationships === null) {
            return null;
        }

        $serialized = [];

        foreach ($relationships as $key => $relationship) {
            $serializedRelationship = $this->serializeRelationship($relationship);

            if ($serializedRelationship !== null) {
                $serialized[$key] = $serializedRelationship;
            }
        }

        if ($serialized === []) {
            return null;
        }

        return (object) $serialized;
    }

    public function serializeResource(JsonApiResourceIdentifierInterface|JsonApiResourceInterface $resource): object|null
    {
        if ($resource instanceof NullInterface) {
            return $resource;
        }

        if ($resource instanceof JsonApiResourceInterface) {
            $serialized = \array_filter(
                [
                    'id' => $resource->getId(),
                    'type' => $resource->getType(),
                    'slug' => $resource->getSlug(),
                    'attributes' => $this->serializeAttributes($resource->getAttributes()),
                    'relationships' => $this->serializeRelationships($resource->getRelationships()),
                    'links' => $this->serializeLinks($resource->getLinks()),
                    'meta' => $this->serializeMeta($resource->getMeta()),
                ],
                static fn(mixed $value): bool => $value !== null,
            );
        } else {
            $serialized = \array_filter(
                [
                    'id' => $resource->getId(),
                    'type' => $resource->getType(),
                    'slug' => $resource->getSlug(),
                ],
                static fn(mixed $value): bool => $value !== null,
            );
        }

        if ($serialized === [] || !isset($serialized['id'], $serialized['type'])) {
            return null;
        }

        return (object) $serialized;
    }

    public function serializeResourceIdentifier(JsonApiResourceIdentifierInterface|JsonApiResourceInterface $resource): object|null
    {
        if ($resource instanceof NullInterface) {
            return $resource;
        }

        $serialized = \array_filter(
            [
                'id' => $resource->getId(),
                'type' => $resource->getType(),
                'slug' => $resource->getSlug(),
            ],
            static fn(mixed $value): bool => $value !== null,
        );

        if ($serialized === [] || !isset($serialized['id'], $serialized['type'])) {
            return null;
        }

        if ($resource instanceof JsonApiResourceInterface) {
            $this->include($resource);
        }

        return (object) $serialized;
    }

    public function serializeSource(JsonApiSourceInterface|null $source): object|null
    {
        if ($source === null) {
            return null;
        }

        $serialized = \array_filter(
            [
                'pointer' => $source->getPointer(),
                'parameter' => $source->getParameter(),
                'header' => $source->getHeader(),
            ],
            static fn(mixed $value): bool => $value !== null,
        );

        if ($serialized === []) {
            return null;
        }

        return (object) $serialized;
    }
}
