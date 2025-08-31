# [PHP Stack](https://github.com/premierstacks/php-stack) by [Tomáš Chochola](https://github.com/tomchochola)

The PHP Stack is a versatile set of utility libraries and helper functions for PHP projects, designed to simplify common development tasks and provide robust support for building scalable and maintainable applications. It offers a cohesive set of tools that integrate seamlessly into any PHP project, helping developers work more efficiently.

## What is Premierstacks

[GitHub Organization → /premierstacks](https://github.com/premierstacks)

Premierstacks is a premier organization delivering a complete ecosystem of libraries, packages, and templates for full-stack web development. It provides end-to-end solutions for backend systems, APIs, and frontend interfaces built on PHP, Laravel, TypeScript, React, and Material Design 3.

Beyond code, Premierstacks focuses on creating a seamless development experience, offering support tools for planning, architecture, deployment, and long-term project maintenance. Each resource within the ecosystem is crafted with precision, adhering to strict quality standards, and designed to scale effortlessly.

From initial project planning and logical architecture to seamless development workflows and optimized production deployment, Premierstacks delivers tools engineered for excellence across every stage of the software lifecycle.

## Why Premierstacks

Premierstacks exists to solve the recurring challenges of modern software development: inconsistency, poor maintainability, and fragmented tooling. It offers a complete ecosystem of libraries, templates, and supporting tools, designed to streamline workflows, enforce best practices, and ensure long-term reliability.

Every component in Premierstacks is crafted with precision, following strict quality standards. From backend logic to frontend interfaces and infrastructure tooling, the focus remains on delivering scalable, future-proof, and seamless solutions. With Premierstacks, development becomes faster, cleaner, and more consistent—right from the first line of code to final deployment.

## What is Tomchochola

[GitHub Personal → /tomchochola](https://github.com/tomchochola)

The Tomchochola GitHub profile features a range of public and private repositories, including experimental tools, independent projects, and legacy systems. These repositories often represent unique solutions that exist outside the strict quality and structural guidelines of Premierstacks.

Here, you’ll find codebases that may belong to different ecosystems, technologies, or experimental workflows. Some projects serve specific use cases, while others are standalone solutions or serve as proof-of-concept prototypes. This profile is a playground for ideas, tools, and resources that might not fully align with the long-term goals of Premierstacks but still offer value and insight into various aspects of software development.

## About the Creator

Tomáš Chochola is a software architect, technical leader, and creator of the Premierstacks ecosystem. With years of experience in backend and frontend development, cloud infrastructure, and team management, he has established a reputation for delivering scalable, maintainable, and robust software solutions.

His expertise spans backend systems built on PHP and Laravel, frontend interfaces designed with React and Material Design 3, and efficient workflows powered by modern tooling and infrastructure solutions.

### Specializations

**Backend Development:** PHP, Laravel, JSON:API<br />
**Frontend Development:** TypeScript, React, Material Design 3<br />
**Tooling:** ESLint, Prettier, Webpack, PHPStan, PHP CS Fixer, Stylelint<br />

## Support the Creator

**[GitHub Sponsors -> /sponsors/tomchochola](https://github.com/sponsors/tomchochola)**

Premierstacks is now freely available under the Creative Commons BY-ND 4.0 license, offering high-quality tools, libraries, and templates to the developer community. While the ecosystem remains open and accessible, its growth, updates, and ongoing maintenance depend on individual support.

By sponsoring Tomáš Chochola on GitHub Sponsors, you directly contribute to the continued development, improvement, and long-term sustainability of Premierstacks. Every contribution supports the creation of reliable, scalable, and future-proof solutions for developers worldwide.

Your support makes a difference—thank you for being a part of this journey.

## License

**Creative Commons Attribution-NoDerivatives 4.0 International**

**Copyright © 2025, Tomáš Chochola <chocholatom1997@gmail.com>. Some rights reserved.**

This license requires that reusers give credit to the creator. It allows reusers to copy and distribute the material in any medium or format in unadapted form only, even for commercial purposes.

### Creative Commons License for Software?

The Creative Commons BY-ND 4.0 license is perfectly suited to Premierstacks. It offers developers the freedom to integrate the software into their projects while preserving the original author’s vision and ensuring consistency across the ecosystem.

Dynamic linking and object-oriented programming practices, such as inheritance or method overriding, are fully permitted. This enables seamless adaptation of the software in dynamic contexts without violating the license. However, static linking, forks, or modifications that alter the software’s original form are prohibited to maintain its integrity and prevent the creation of fragmented or subpar versions.

By protecting the core quality and unity of Premierstacks, this license ensures that developers can confidently rely on it as a trusted, high-standard solution for their projects.

## Module exports

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

## Getting Started

**1. Review the documentation and license**

Ensure this package fits your needs and that you agree with the terms.

**2. Install the package**

Setup composer repostory:

```bash
composer config repositories.premierstacks/php-stack '{"type": "vcs", "url": "https://github.com/premierstacks/php-stack.git", "no-api": true}'
```

Install using composer:

```bash
composer require --dev premierstacks/php-stack:@dev
```

## Contact

**📧 Email: <chocholatom1997@gmail.com>**<br />
**👨 GitHub Personal: [https://github.com/tomchochola](https://github.com/tomchochola)**<br />
**🏢 GitHub Organization: [https://github.com/premierstacks](https://github.com/premierstacks)**<br />
**💰 GitHub Sponsors: [https://github.com/sponsors/tomchochola](https://github.com/sponsors/tomchochola)**<br />
