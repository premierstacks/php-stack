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
 * Tomáš Chochola: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 *
 * Premierstacks: The Organization
 * - GitHub: https://github.com/premierstacks
 */

declare(strict_types=1);

namespace Tests\Unit\JsonApi;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use Premierstacks\PhpUtil\JsonApi\JsonApi;
use Premierstacks\PhpUtil\JsonApi\JsonApiAttributes;
use Premierstacks\PhpUtil\JsonApi\JsonApiDocument;
use Premierstacks\PhpUtil\JsonApi\JsonApiError;
use Premierstacks\PhpUtil\JsonApi\JsonApiErrors;
use Premierstacks\PhpUtil\JsonApi\JsonApiLink;
use Premierstacks\PhpUtil\JsonApi\JsonApiLinks;
use Premierstacks\PhpUtil\JsonApi\JsonApiMeta;
use Premierstacks\PhpUtil\JsonApi\JsonApiRelationship;
use Premierstacks\PhpUtil\JsonApi\JsonApiRelationships;
use Premierstacks\PhpUtil\JsonApi\JsonApiResource;
use Premierstacks\PhpUtil\JsonApi\JsonApiResourceIdentifier;
use Premierstacks\PhpUtil\JsonApi\JsonApiSerializer;
use Premierstacks\PhpUtil\JsonApi\JsonApiSource;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Small]
#[CoversClass(JsonApiSerializer::class)]
class JsonApiSerializerTest extends TestCase
{
    #[Test]
    public function testSerialize(): void
    {
        $meta = new JsonApiMeta(
            [
                'meta' => 'meta',
            ],
        );

        $links = new JsonApiLinks(
            [
                'self' => new JsonApiLink(
                    'https://example.com',
                    'rel',
                    'https://example.com/describedby',
                    'Example',
                    'text/html',
                    [
                        'en',
                    ],
                    $meta,
                ),
            ],
        );

        $attributes = new JsonApiAttributes(
            [
                'key' => 'value',
            ],
        );

        $serializer = new JsonApiSerializer();

        $document = new JsonApiDocument(
            [
                new JsonApiResource(
                    'id',
                    'slug',
                    'type',
                    $attributes,
                    new JsonApiRelationships(
                        [
                            'relationship' => new JsonApiRelationship(
                                new JsonApiResource(
                                    'idd',
                                    'slug',
                                    'type',
                                    $attributes,
                                    new JsonApiRelationships(
                                        [
                                            'relationship' => new JsonApiRelationship(
                                                new JsonApiResourceIdentifier(
                                                    'iddd',
                                                    'slug',
                                                    'type',
                                                ),
                                                $links,
                                                $meta,
                                            ),
                                        ],
                                    ),
                                    $links,
                                    $meta,
                                ),
                                $links,
                                $meta,
                            ),
                        ],
                    ),
                    $links,
                    $meta,
                ),
            ],
            new JsonApiErrors(
                [
                    new JsonApiError(
                        'id',
                        $links,
                        '450',
                        '1000',
                        'Test Error',
                        'Test Error Detail',
                        new JsonApiSource(
                            '/data/attributes/title',
                        ),
                        $meta,
                    ),
                ],
            ),
            $meta,
            $links,
            new JsonApi(
                '1.0',
                [
                    'https://jsonapi.org/ext/atomic',
                ],
                [
                    'http://example.com/profiles/flexible-pagination',
                ],
                $meta,
            ),
        );

        $json = $serializer->serialize($document);
        $status = $serializer->detectStatus($json);

        $got = \json_encode($json, \JSON_THROW_ON_ERROR);
        $expected = \json_encode([
            'data' => [
                [
                    'id' => 'id',
                    'slug' => 'slug',
                    'type' => 'type',
                    'attributes' => [
                        'key' => 'value',
                    ],
                    'relationships' => [
                        'relationship' => [
                            'data' => [
                                'id' => 'idd',
                                'slug' => 'slug',
                                'type' => 'type',
                            ],
                            'links' => [
                                'self' => [
                                    'href' => 'https://example.com',
                                    'rel' => 'rel',
                                    'describedby' => 'https://example.com/describedby',
                                    'title' => 'Example',
                                    'type' => 'text/html',
                                    'hreflang' => [
                                        'en',
                                    ],
                                    'meta' => [
                                        'meta' => 'meta',
                                    ],
                                ],
                            ],
                            'meta' => [
                                'meta' => 'meta',
                            ],
                        ],
                    ],
                    'links' => [
                        'self' => [
                            'href' => 'https://example.com',
                            'rel' => 'rel',
                            'describedby' => 'https://example.com/describedby',
                            'title' => 'Example',
                            'type' => 'text/html',
                            'hreflang' => [
                                'en',
                            ],
                            'meta' => [
                                'meta' => 'meta',
                            ],
                        ],
                    ],
                    'meta' => [
                        'meta' => 'meta',
                    ],
                ],
            ],
            'errors' => [
                [
                    'id' => 'id',
                    'links' => [
                        'self' => [
                            'href' => 'https://example.com',
                            'rel' => 'rel',
                            'describedby' => 'https://example.com/describedby',
                            'title' => 'Example',
                            'type' => 'text/html',
                            'hreflang' => [
                                'en',
                            ],
                            'meta' => [
                                'meta' => 'meta',
                            ],
                        ],
                    ],
                    'status' => '450',
                    'code' => '1000',
                    'title' => 'Test Error',
                    'detail' => 'Test Error Detail',
                    'source' => [
                        'pointer' => '/data/attributes/title',
                    ],
                    'meta' => [
                        'meta' => 'meta',
                    ],
                ],
            ],
            'meta' => [
                'meta' => 'meta',
            ],
            'links' => [
                'self' => [
                    'href' => 'https://example.com',
                    'rel' => 'rel',
                    'describedby' => 'https://example.com/describedby',
                    'title' => 'Example',
                    'type' => 'text/html',
                    'hreflang' => [
                        'en',
                    ],
                    'meta' => [
                        'meta' => 'meta',
                    ],
                ],
            ],
            'jsonapi' => [
                'version' => '1.0',
                'ext' => [
                    'https://jsonapi.org/ext/atomic',
                ],
                'profile' => [
                    'http://example.com/profiles/flexible-pagination',
                ],
                'meta' => [
                    'meta' => 'meta',
                ],
            ],
            'included' => [
                [
                    'id' => 'idd',
                    'slug' => 'slug',
                    'type' => 'type',
                    'attributes' => [
                        'key' => 'value',
                    ],
                    'relationships' => [
                        'relationship' => [
                            'data' => [
                                'id' => 'iddd',
                                'slug' => 'slug',
                                'type' => 'type',
                            ],
                            'links' => [
                                'self' => [
                                    'href' => 'https://example.com',
                                    'rel' => 'rel',
                                    'describedby' => 'https://example.com/describedby',
                                    'title' => 'Example',
                                    'type' => 'text/html',
                                    'hreflang' => [
                                        'en',
                                    ],
                                    'meta' => [
                                        'meta' => 'meta',
                                    ],
                                ],
                            ],
                            'meta' => [
                                'meta' => 'meta',
                            ],
                        ],
                    ],
                    'links' => [
                        'self' => [
                            'href' => 'https://example.com',
                            'rel' => 'rel',
                            'describedby' => 'https://example.com/describedby',
                            'title' => 'Example',
                            'type' => 'text/html',
                            'hreflang' => [
                                'en',
                            ],
                            'meta' => [
                                'meta' => 'meta',
                            ],
                        ],
                    ],
                    'meta' => [
                        'meta' => 'meta',
                    ],
                ],
            ],
        ], \JSON_THROW_ON_ERROR);

        static::assertSame(450, $status);
        static::assertJsonStringEqualsJsonString($expected, $got);
    }
}
