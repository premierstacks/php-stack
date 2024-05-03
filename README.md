# [PHP Util](https://github.com/premierstacks/php-util) by [Tomáš Chochola](https://github.com/tomchochola)

Elevate PHP development with PHP Util: a comprehensive suite offering innovative solutions for data handling, error management, and more. Designed for streamlined integration and enhanced efficiency.

PHP Util provides a versatile range of utilities aimed at optimizing PHP development. This toolset, crafted for practicality and innovation, addresses common to complex challenges in PHP projects, offering solutions for data encoding, error handling, and versatile I/O operations. With PHP Util, integration is effortless, allowing you to enhance your development process with advanced functionalities from the start. The suite is a result of in-depth research and is continuously updated to ensure alignment with the latest PHP standards and practices, guaranteeing reliability and premier quality in your development endeavors.

## 👌 Top Reasons to Opt for PHP Util

PHP Util isn't just a collection of utilities; it's a pivotal tool designed to enhance your PHP development, ensuring efficiency, reliability, and innovation at every step.

### ⏱️ Setup in Just 5 Minutes

Dive into your PHP projects with PHP Util, crafted for seamless integration. This comprehensive suite equips you with advanced functionalities right from the start, allowing you to elevate your PHP development with ease and precision.

### 🕒 Hundreds of Hours of Research, So You Don't Have To

PHP Util is the result of exhaustive research and a deep understanding of PHP's complexities. By incorporating PHP Util into your projects, you access a treasure trove of optimized solutions and methodologies, ensuring your development is based on refined knowledge and best practices.

### 🎚️ Minimal Setup, Maximum Utility

Achieve exceptional functionality with minimal configuration effort. PHP Util simplifies the incorporation of complex PHP utilities, making high-quality development accessible and manageable, while providing a wide array of tools for diverse development needs.

### 📘 Zero Expertise Required

Regardless of your experience level, PHP Util is designed to be intuitive and user-friendly. This ensures that developers of all skill levels can leverage its full spectrum of utilities, elevating the quality and efficiency of PHP development across the board.

### 🔄 Continuously Updated

Stay at the cutting edge of PHP development with PHP Util. Regular updates ensure the suite remains aligned with the latest PHP features and best practices, keeping your projects modern, efficient, and compliant with current standards.

### ⚔️ Battle-Tested Reliability

Depend on a utility suite that has been rigorously tested across a broad range of PHP projects. PHP Util delivers consistent, reliable results, enhancing the robustness and maintainability of your PHP code, irrespective of project scale or complexity.

### 🏆 Premier Quality Guarantee

Opting for PHP Util signifies a commitment to excellence in PHP development. Beyond basic utility functions, PHP Util offers a holistic solution that enriches your projects with unparalleled efficiency and performance, setting new benchmarks in PHP development.

## 🛡️ License & Usage

**Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved**

[![License](https://img.shields.io/badge/License-©_Proprietary-blue.svg)](LICENSE.md)

This software is the exclusive property of Tomáš Chochola, protected by copyright laws.<br />
Although the source code may be accessible, it is not free for use without a valid license.<br />
A valid license, obtainable through proper channels, is required for any software use.<br />
For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.

The full license terms are detailed in the [LICENSE.md](LICENSE.md) file within the source code repository.<br />
The terms are subject to changes. Users are encouraged to review them periodically.

### Acquiring a License

To use this software, you must obtain a valid license available through a monthly subscription on the [GitHub Sponsors platform](https://github.com/sponsors/tomchochola).<br />
This platform has been chosen for its reliability and ease of use, providing a secure and straightforward way to manage your subscription.

## 🖍️ Highlights

- **Advanced Encoding and Decoding**: PHP Util offers sophisticated utilities for handling various data formats, including CSV, JSON, XML, and more, ensuring efficient and accurate data processing.
- **Streamlined Error and Exception Handling**: Enhance the reliability of your PHP applications with PHP Util's robust error and exception handling utilities, designed for clarity and ease of debugging.
- **Versatile Input/Output Operations**: PHP Util provides comprehensive tools for file handling, data streaming, and input/output operations, maximizing flexibility and efficiency in data management.
- **Extensive Collection of Utilities**: From array manipulation and string operations to security enhancements and validation tools, PHP Util covers a wide spectrum of functionalities, catering to diverse development needs.
- **Optimized for Performance**: Each utility within PHP Util is optimized for maximum performance, ensuring your PHP applications run smoothly and efficiently.

## 🎬 Get Started

### 1️⃣ License Acquisition

Secure your license at [Tomáš Chochola's GitHub Sponsors page](https://github.com/sponsors/tomchochola).

### 2️⃣ Package Installation

Add the following to your `composer.json`:

```json
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/premierstacks/php-util.git"
    }
]
```

Then, execute:

```shell
composer require premierstacks/php-util:@dev
```

### 3️⃣ Utilize PHP Util

Leverage the extensive utilities provided by PHP Util in your PHP projects, enhancing functionality and efficiency with ease.

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Premierstacks\PhpUtil\IO\ResourceObject;
use Premierstacks\PhpUtil\Mixed\Assert;
use Premierstacks\PhpUtil\Mixed\Check;
use Premierstacks\PhpUtil\Mixed\Is;
use Premierstacks\PhpUtil\Types\Resources;

// Runtime check for mixed types
$listOfInt = Check::listOf($_GET['ints'], static fn (mixed $a): int => Check::int($a)); // [1, 2, 3]
$listOfArrayOfString = Check::listOf($_POST['arrays'], static fn (mixed $a): array => Check::arrayOf($a, static fn (mixed $b): string => Check::string($b))); // [['key' => 'value']]

// Assertion check for mixed types
$listOfInts = Assert::listOf($_GET['ints'], static fn (mixed $a): int => Assert::int($a)); // [1, 2, 3]
$listOfArrayOfString = Assert::listOf($_POST['arrays'], static fn (mixed $a): array => Assert::arrayOf($a, static fn (mixed $b): string => Assert::string($b))); // [['key' => 'value']]

// Is check for mixed types
$isListOfInt = Is::listOf($_GET['ints'], static fn (mixed $a): int => Check::int($a)); // [1, 2, 3]
$isListOfArrayOfString = Is::listOf($_POST['arrays'], static fn (mixed $a): array => Check::arrayOf($a, static fn (mixed $b): string => Check::string($b))); // [['key' => 'value']]

// Resources object wrapper
$resource = new ResourceObject(Resources::temp());
$resource->fputcsv(['a', 'b', 'c']);
$resource->rewind();
$resource->fpassthru(); // prints a,b,c
```

### 4️⃣ Attribution

Please ensure to manually give credits to the authors in your project documentation or wherever appropriate, as per the license agreement.

## 🤵 The Proprietor: Tomáš Chochola

Elite developer crafting exclusive, enterprise-grade software, professional packages, and premium templates to elevate your digital landscape.

- **Role**: The Creator, Proprietor & Project Visionary
- **Email:** <chocholatom1997@gmail.com>
- **GitHub:** [https://github.com/tomchochola](https://github.com/tomchochola)
- **Sponsor & License:** [https://github.com/sponsors/tomchochola](https://github.com/sponsors/tomchochola)

## 🌐 Discover Tomáš Chochola's GitHub Universe

Explore the boundless creativity and innovation in [Tomáš Chochola's GitHub repository](https://github.com/tomchochola). As the epicenter of my digital creations, it offers an extensive collection of avant-garde software packages, refined libraries, and polished templates, meticulously crafted to enhance your development journey. Immerse yourself in a world where efficiency and elegance converge, and elevate your projects with tools that redefine excellence.

## 💰 Empower Innovation: Support and Subscribe

Your support transcends mere contributions; it's the lifeblood of innovation and growth. By subscribing for premium access or becoming a sponsor, you directly contribute to the advancement of high-caliber software. Embrace the opportunity to be part of a visionary journey by visiting my [GitHub Sponsors profile](https://github.com/sponsors/tomchochola).

## 🤝 Join Forces with Tomáš Chochola

Embark on a collaborative venture with a developer whose passion for perfection knows no bounds. Whether it's for groundbreaking startups, global enterprises, or transformative government projects, my arsenal of skills is at your command. Let's merge visions and craftsmanship to forge software that stands a class apart. Connect with me at [chocholatom1997@gmail.com](mailto:chocholatom1997@gmail.com) for collaborations that transcend conventional boundaries.
