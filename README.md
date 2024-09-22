# [PHP Stack](https://github.com/premierstacks/php-stack) by [Tomáš Chochola](https://github.com/tomchochola)

## 💡 Idea Behind Premierstacks

Premierstacks is a comprehensive solution designed to cover both the development environment and the runtime provisioning/release process to production servers.

It includes everything from basic project structures to configurations for unit tests, static analysis, linters, automatic code fixers, and compilation or transpilation. Premierstacks ensures that your entire workflow, from development to production deployment, operates smoothly.

With a single license, you gain access to multiple libraries and guides that allow you to focus on business logic while Premierstacks handles both development and runtime environments.

This software is proprietary and designed for serious developers who value precision and professionalism. Ensure compliance by securing your license today.

## ⚡ Why Choose This Solution?

- **Premier Quality**

  Crafted for discerning developers and teams aiming for the highest standards.

- **Expertly Crafted**

  Built by professionals after hundreds of hours of research and testing.

- **Production-Ready**

  Fully tested in real-world production environments.

- **Efficient Setup**

  Get up and running with minimal effort and immediate results.

- **Regular Updates**

  Stay aligned with the latest standards and best practices.

## 🛡️ License & Usage

**Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved**

[![License](https://img.shields.io/badge/License-©_Proprietary-blue.svg)](LICENSE.md)

This software is proprietary property of Tomáš Chochola and protected by copyright laws.<br />
A valid license is required for any use or manipulation of the software or source code.<br />
The full license terms are detailed in the LICENSE.md file within the source code repository.

One license grants you access to all Premierstacks products, ensuring a unified solution for your development and production needs.

**Purchase a license here**: [GitHub Sponsors](https://github.com/sponsors/tomchochola)

**See full terms in**: [LICENSE.md](LICENSE.md)

## 📦 Module exports

Here are the available module exports:

```php
use Premierstacks/PhpStack/Debug/Debugf;
use Premierstacks/PhpStack/Debug/Errorf;
use Premierstacks/PhpStack/Encoding/Csv;
use Premierstacks/PhpStack/Encoding/DataUri;
use Premierstacks/PhpStack/Encoding/Hash;
use Premierstacks/PhpStack/Encoding/Json;
use Premierstacks/PhpStack/Encoding/Signature;
use Premierstacks/PhpStack/Encoding/Svg;
use Premierstacks/PhpStack/Enums/Undefined;
use Premierstacks/PhpStack/Enums/Unknown;
use Premierstacks/PhpStack/Fake/Svg;
use Premierstacks/PhpStack/Http/Client;
use Premierstacks/PhpStack/Http/Message;
use Premierstacks/PhpStack/Http/NetworkException;
use Premierstacks/PhpStack/Http/Request;
use Premierstacks/PhpStack/Http/Response;
use Premierstacks/PhpStack/Http/Stream;
use Premierstacks/PhpStack/Http/Uri;
use Premierstacks/PhpStack/IO/ResourceObject;
use Premierstacks/PhpStack/JsonApi/JsonApi;
use Premierstacks/PhpStack/JsonApi/JsonApiAttributes;
use Premierstacks/PhpStack/JsonApi/JsonApiDocument;
use Premierstacks/PhpStack/JsonApi/JsonApiDocumentInterface;
use Premierstacks/PhpStack/JsonApi/JsonApiError;
use Premierstacks/PhpStack/JsonApi/JsonApiErrorInterface;
use Premierstacks/PhpStack/JsonApi/JsonApiErrors;
use Premierstacks/PhpStack/JsonApi/JsonApiInterface;
use Premierstacks/PhpStack/JsonApi/JsonApiLink;
use Premierstacks/PhpStack/JsonApi/JsonApiLinkInterface;
use Premierstacks/PhpStack/JsonApi/JsonApiLinks;
use Premierstacks/PhpStack/JsonApi/JsonApiMeta;
use Premierstacks/PhpStack/JsonApi/JsonApiRelationship;
use Premierstacks/PhpStack/JsonApi/JsonApiRelationshipInterface;
use Premierstacks/PhpStack/JsonApi/JsonApiRelationships;
use Premierstacks/PhpStack/JsonApi/JsonApiResource;
use Premierstacks/PhpStack/JsonApi/JsonApiResourceIdentifier;
use Premierstacks/PhpStack/JsonApi/JsonApiResourceIdentifierInterface;
use Premierstacks/PhpStack/JsonApi/JsonApiResourceInterface;
use Premierstacks/PhpStack/JsonApi/JsonApiSerializer;
use Premierstacks/PhpStack/JsonApi/JsonApiSource;
use Premierstacks/PhpStack/JsonApi/JsonApiSourceInterface;
use Premierstacks/PhpStack/JsonApi/NullInterface;
use Premierstacks/PhpStack/JsonApi/NullJsonApiLink;
use Premierstacks/PhpStack/JsonApi/NullJsonApiResource;
use Premierstacks/PhpStack/JsonApi/NullJsonApiResourceIdentifier;
use Premierstacks/PhpStack/JsonApi/ThrowableDebugJsonApiMeta;
use Premierstacks/PhpStack/JsonApi/ThrowableJsonApiError;
use Premierstacks/PhpStack/JsonApi/ThrowableJsonApiErrors;
use Premierstacks/PhpStack/Mixed/Assert;
use Premierstacks/PhpStack/Mixed/Check;
use Premierstacks/PhpStack/Mixed/Filter;
use Premierstacks/PhpStack/Mixed/Is;
use Premierstacks/PhpStack/Random/Random;
use Premierstacks/PhpStack/Structures/Struct;
use Premierstacks/PhpStack/Structures/Structs;
use Premierstacks/PhpStack/Testing/PHPUnit;
use Premierstacks/PhpStack/Testing/TestIntEnum;
use Premierstacks/PhpStack/Testing/TestInterface;
use Premierstacks/PhpStack/Testing/TestStringEnum;
use Premierstacks/PhpStack/Testing/TestTrait;
use Premierstacks/PhpStack/Types/Arrays;
use Premierstacks/PhpStack/Types/Files;
use Premierstacks/PhpStack/Types/Resources;
use Premierstacks/PhpStack/Types/Strings;
```

## 🚀 Getting Started

1️⃣ **Review the documentation and license**

Ensure this package fits your needs and that you agree with the terms.

2️⃣ **Purchase a license**

Obtain a valid license through [GitHub Sponsors](https://github.com/sponsors/tomchochola).

3️⃣ **Install the package**

Setup composer repostory:

```bash
composer config repositories.premierstacks/php-stack git https://github.com/premierstacks/php-stack.git
```

Install using composer:

```bash
composer require --dev premierstacks/php-stack:@dev
```

4️⃣ **Use the package**

Start using the package in your project.

## 👤 The Author: Tomáš Chochola

Tomáš Chochola is a leading software developer known for delivering precision-crafted, enterprise-grade solutions. With deep expertise in multiple cutting-edge technologies, Tomáš focuses on ensuring top-tier code quality and efficiency for every project.

**Email**: <chocholatom1997@gmail.com><br />
**Premierstacks website**: [https://premierstacks.com](https://premierstacks.com)<br />
**Personal GitHub**: [https://github.com/tomchochola](https://github.com/tomchochola)<br />
**Premierstacks GitHub**: [https://github.com/premierstacks](https://github.com/premierstacks)<br />
**GitHub Sponsors**: [https://github.com/sponsors/tomchochola](https://github.com/sponsors/tomchochola)

His areas of specialization include:

- DevOps and AWS
- PHP and Laravel
- Secure coding practices
- Code style and best practices
- Helper functions and libraries
- TypeScript, React, and Webpack
- Reusable templates and configuration stacks
- Development on Windows 11 and Ubuntu 22/24 (WSL2)
- ESLint, Prettier, PHP CS Fixer, PostCSS, and Stylelint

## 💼 Hire Me

Whether you need short-term code assistance, in-depth analysis, or help integrating premium packages, I'm available for collaboration. Let's take your project to the next level.

You can also support my work by becoming a sponsor through [GitHub Sponsors](https://github.com/sponsors/tomchochola).

If you're interested in hiring me for any of the above or for solving IT issues, feel free to reach out. I'm open to collaboration, whether it's for new packages, ongoing projects, or quick IT fixes.

## 🌳 Project Structure (Tree)

Below is an example of the project structure you will receive upon purchasing the stack. This allows you to see what’s included and know exactly what you are paying for:

```sh
.
├── AUTHORS.md
├── LICENSE.md
├── Makefile
├── README.md
├── composer.json
├── eslint.config.js
├── package.json
├── phpstan.neon
├── phpunit.xml
├── prettier.config.js
├── samples
│   ├── json_api_errors.php
│   ├── json_api_resources.php
│   └── resources.php
├── src
│   ├── Debug
│   │   ├── Debugf.php
│   │   └── Errorf.php
│   ├── Encoding
│   │   ├── Csv.php
│   │   ├── DataUri.php
│   │   ├── Hash.php
│   │   ├── Json.php
│   │   ├── Signature.php
│   │   └── Svg.php
│   ├── Enums
│   │   ├── Undefined.php
│   │   └── Unknown.php
│   ├── Fake
│   │   └── Svg.php
│   ├── Http
│   │   ├── Client.php
│   │   ├── Message.php
│   │   ├── NetworkException.php
│   │   ├── Request.php
│   │   ├── Response.php
│   │   ├── Stream.php
│   │   └── Uri.php
│   ├── IO
│   │   └── ResourceObject.php
│   ├── JsonApi
│   │   ├── JsonApi.php
│   │   ├── JsonApiAttributes.php
│   │   ├── JsonApiDocument.php
│   │   ├── JsonApiDocumentInterface.php
│   │   ├── JsonApiError.php
│   │   ├── JsonApiErrorInterface.php
│   │   ├── JsonApiErrors.php
│   │   ├── JsonApiInterface.php
│   │   ├── JsonApiLink.php
│   │   ├── JsonApiLinkInterface.php
│   │   ├── JsonApiLinks.php
│   │   ├── JsonApiMeta.php
│   │   ├── JsonApiRelationship.php
│   │   ├── JsonApiRelationshipInterface.php
│   │   ├── JsonApiRelationships.php
│   │   ├── JsonApiResource.php
│   │   ├── JsonApiResourceIdentifier.php
│   │   ├── JsonApiResourceIdentifierInterface.php
│   │   ├── JsonApiResourceInterface.php
│   │   ├── JsonApiSerializer.php
│   │   ├── JsonApiSource.php
│   │   ├── JsonApiSourceInterface.php
│   │   ├── NullInterface.php
│   │   ├── NullJsonApiLink.php
│   │   ├── NullJsonApiResource.php
│   │   ├── NullJsonApiResourceIdentifier.php
│   │   ├── ThrowableDebugJsonApiMeta.php
│   │   ├── ThrowableJsonApiError.php
│   │   └── ThrowableJsonApiErrors.php
│   ├── Mixed
│   │   ├── Assert.php
│   │   ├── Check.php
│   │   ├── Filter.php
│   │   └── Is.php
│   ├── Random
│   │   └── Random.php
│   ├── Structures
│   │   ├── Struct.php
│   │   └── Structs.php
│   ├── Testing
│   │   ├── PHPUnit.php
│   │   ├── TestIntEnum.php
│   │   ├── TestInterface.php
│   │   ├── TestStringEnum.php
│   │   └── TestTrait.php
│   └── Types
│       ├── Arrays.php
│       ├── Files.php
│       ├── Resources.php
│       └── Strings.php
└── tests
    └── Unit
        ├── Http
        │   ├── ClientTest.php
        │   ├── MessageTest.php
        │   ├── NetworkExceptionTest.php
        │   ├── RequestTest.php
        │   ├── ResponseTest.php
        │   ├── StreamTest.php
        │   └── UriTest.php
        ├── JsonApi
        │   └── JsonApiSerializerTest.php
        ├── Mixed
        │   ├── AssertTest.php
        │   └── CheckTest.php
        ├── Structures
        │   └── StructTest.php
        └── TestCase.php

20 directories, 89 files
```
