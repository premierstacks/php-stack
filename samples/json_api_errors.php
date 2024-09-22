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

require_once __DIR__ . '/../vendor/autoload.php';

use Premierstacks\PhpStack\Encoding\Json;
use Premierstacks\PhpStack\JsonApi\JsonApiDocument;
use Premierstacks\PhpStack\JsonApi\JsonApiError;
use Premierstacks\PhpStack\JsonApi\JsonApiErrors;
use Premierstacks\PhpStack\JsonApi\JsonApiSerializer;
use Premierstacks\PhpStack\JsonApi\JsonApiSource;

$errors = new JsonApiErrors(
    [
        new JsonApiError(
            'bfe952eb-53ce-474a-ba8e-cef101b3cb9d',
            null,
            '400',
            '1000',
            'name is required',
            'the name field is required for the resource',
            new JsonApiSource(
                '/data/attributes/name',
            ),
        ),
    ],
);

$document = new JsonApiDocument(
    null,
    $errors,
);

$serializer = new JsonApiSerializer();

$serialized = $serializer->serialize($document);

echo Json::encode($serialized, \JSON_PRETTY_PRINT);
