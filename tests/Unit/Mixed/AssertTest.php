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
 * The Proprietor: Tomáš Chochola
 * - Role: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 */

declare(strict_types=1);

namespace Tests\Unit\Mixed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use Tests\Unit\TestCase;
use Tomchochola\PhpUtil\Mixed\Assert;
use Tomchochola\PhpUtil\Testing\PHPUnit;
use Tomchochola\PhpUtil\Testing\TestIntEnum;
use Tomchochola\PhpUtil\Testing\TestStringEnum;

/**
 * @internal
 */
#[Small]
#[CoversClass(Assert::class)]
class AssertTest extends TestCase
{
    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testA(mixed $value, array $types): void
    {
        if (!static::oneOf(['std-class-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::a($value, \stdClass::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::array($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testArrayKey(mixed $value, array $types): void
    {
        if (!static::oneOf(['string', 'int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::arrayKey($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::arrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testBool(mixed $value, array $types): void
    {
        if (!static::oneOf(['bool'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::bool($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testCallable(mixed $value, array $types): void
    {
        if (!static::oneOf(['callable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::callable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testCallableString(mixed $value, array $types): void
    {
        if (!static::oneOf(['callable-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::callableString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testClassString(mixed $value, array $types): void
    {
        if (!static::oneOf(['class-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::classString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testClosedResource(mixed $value, array $types): void
    {
        if (!static::oneOf(['closed-resource'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::closedResource($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testCountable(mixed $value, array $types): void
    {
        if (!static::oneOf(['countable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::countable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testEnum(mixed $value, array $types): void
    {
        if (!static::oneOf(['enum'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::enum($value, \BackedEnum::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testFalse(mixed $value, array $types): void
    {
        if (!static::oneOf(['false'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::false($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testFloat(mixed $value, array $types): void
    {
        if (!static::oneOf(['float'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::float($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testIn(mixed $value, array $types): void
    {
        if (!static::oneOf(['true'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::in($value, [true]));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testInstance(mixed $value, array $types): void
    {
        if (!static::oneOf(['std-object'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::instance($value, \stdClass::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::int($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testIntArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['int-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::intArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testIntArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['int-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::intArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testIntEnum(mixed $value, array $types): void
    {
        if (!static::oneOf(['test-int-enum'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::intEnum($value, TestIntEnum::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testIntIterable(mixed $value, array $types): void
    {
        if (!static::oneOf(['int-iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::intIterable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testIntIterableOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['int-iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::intIterableOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testInterfaceString(mixed $value, array $types): void
    {
        if (!static::oneOf(['interface-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::interfaceString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testIterable(mixed $value, array $types): void
    {
        if (!static::oneOf(['iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::iterable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testIterableOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::iterableOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testList(mixed $value, array $types): void
    {
        if (!static::oneOf(['list'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::list($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testListOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['list'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::listOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNegativeInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['negative-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::negativeInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonEmptyArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-empty-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonEmptyArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonEmptyArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-empty-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonEmptyArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonEmptyIntArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-empty-int-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonEmptyIntArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonEmptyIntArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-empty-int-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonEmptyIntArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonEmptyList(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-empty-list'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonEmptyList($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonEmptyListOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-empty-list'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonEmptyListOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonEmptyString(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-empty-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonEmptyString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonEmptyStringArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-empty-string-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonEmptyStringArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonEmptyStringArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-empty-string-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonEmptyStringArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonFalsyString(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-falsy-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonFalsyString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonNegativeInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-negative-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonNegativeInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonPositiveInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-positive-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonPositiveInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNonZeroInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['non-zero-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nonZeroInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNotFalse(mixed $value, array $types): void
    {
        if ($value === false) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::notFalse($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNotNegativeOne(mixed $value, array $types): void
    {
        if ($value === -1) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::notNegativeOne($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNotNull(mixed $value, array $types): void
    {
        if ($value === null) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::notNull($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNotPositiveOne(mixed $value, array $types): void
    {
        if ($value === 1) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::notPositiveOne($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNotTrue(mixed $value, array $types): void
    {
        if ($value === true) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::notTrue($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNotZero(mixed $value, array $types): void
    {
        if ($value === 0) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::notZero($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNull(mixed $value, array $types): void
    {
        if (!static::oneOf(['null'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::null($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableA(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'std-class-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableA($value, \stdClass::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableArrayKey(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'string', 'int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableArrayKey($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableBool(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'bool'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableBool($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableCallable(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'callable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableCallable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableCallableString(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'callable-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableCallableString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableClassString(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'class-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableClassString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableClosedResource(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'closed-resource'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableClosedResource($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableCountable(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'countable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableCountable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableEnum(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'enum'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableEnum($value, \BackedEnum::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableFalse(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'false'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableFalse($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableFloat(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'float'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableFloat($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableIn(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'true'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableIn($value, [true]));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableInstance(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'std-object'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableInstance($value, \stdClass::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableIntArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'int-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableIntArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableIntArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'int-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableIntArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableIntEnum(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'test-int-enum'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableIntEnum($value, TestIntEnum::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableIntIterable(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'int-iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableIntIterable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableIntIterableOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'int-iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableIntIterableOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableInterfaceString(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'interface-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableInterfaceString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableIterable(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableIterable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableIterableOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableIterableOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableList(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'list'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableList($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableListOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'list'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableListOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNegativeInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'negative-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNegativeInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonEmptyArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-empty-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonEmptyArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonEmptyArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-empty-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonEmptyArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonEmptyIntArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-empty-int-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonEmptyIntArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonEmptyIntArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-empty-int-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonEmptyIntArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonEmptyList(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-empty-list'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonEmptyList($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonEmptyListOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-empty-list'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonEmptyListOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonEmptyString(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-empty-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonEmptyString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonEmptyStringArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-empty-string-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonEmptyStringArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonEmptyStringArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-empty-string-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonEmptyStringArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonFalsyString(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-falsy-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonFalsyString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonNegativeInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-negative-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonNegativeInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonPositiveInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-positive-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonPositiveInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNonZeroInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'non-zero-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNonZeroInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNumeric(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'numeric'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNumeric($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableNumericString(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'numeric-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableNumericString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableObject(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'object'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableObject($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableOpenResource(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'open-resource'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableOpenResource($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullablePositiveInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'positive-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullablePositiveInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableResource(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'resource'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableResource($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableScalar(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'scalar'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableScalar($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableString(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableStringArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'string-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableStringArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableStringArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'string-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableStringArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableStringEnum(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'test-string-enum'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableStringEnum($value, TestStringEnum::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableStringIterable(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'string-iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableStringIterable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableStringIterableOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'string-iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableStringIterableOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableStringable(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'stringable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableStringable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableTraitString(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'trait-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableTraitString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNullableTrue(mixed $value, array $types): void
    {
        if (!static::oneOf(['null', 'true'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::nullableTrue($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNumeric(mixed $value, array $types): void
    {
        if (!static::oneOf(['numeric'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::numeric($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testNumericString(mixed $value, array $types): void
    {
        if (!static::oneOf(['numeric-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::numericString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testObject(mixed $value, array $types): void
    {
        if (!static::oneOf(['object'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::object($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testOpenResource(mixed $value, array $types): void
    {
        if (!static::oneOf(['open-resource'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::openResource($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testPositiveInt(mixed $value, array $types): void
    {
        if (!static::oneOf(['positive-int'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::positiveInt($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testResource(mixed $value, array $types): void
    {
        if (!static::oneOf(['resource'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::resource($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testScalar(mixed $value, array $types): void
    {
        if (!static::oneOf(['scalar'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::scalar($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testString(mixed $value, array $types): void
    {
        if (!static::oneOf(['string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::string($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testStringArray(mixed $value, array $types): void
    {
        if (!static::oneOf(['string-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::stringArray($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testStringArrayOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['string-array'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::stringArrayOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testStringEnum(mixed $value, array $types): void
    {
        if (!static::oneOf(['test-string-enum'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::stringEnum($value, TestStringEnum::class));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testStringIterable(mixed $value, array $types): void
    {
        if (!static::oneOf(['string-iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::stringIterable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testStringIterableOf(mixed $value, array $types): void
    {
        if (!static::oneOf(['string-iterable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::stringIterableOf($value, static fn(mixed $value): mixed => $value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testStringable(mixed $value, array $types): void
    {
        if (!static::oneOf(['stringable'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::stringable($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testTraitString(mixed $value, array $types): void
    {
        if (!static::oneOf(['trait-string'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::traitString($value));
    }

    /**
     * @param list<string> $types
     */
    #[Test]
    #[DataProvider('providesValue')]
    public function testTrue(mixed $value, array $types): void
    {
        if (!static::oneOf(['true'], $types)) {
            $this->expectException(\InvalidArgumentException::class);
        }

        static::assertSame($value, Assert::true($value));
    }

    /**
     * @param list<string> $match
     * @param list<string> $enum
     */
    public static function oneOf(array $match, array $enum): bool
    {
        foreach ($match as $type) {
            if (\in_array($type, $enum, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return iterable<string, array{mixed, list<string>}>
     */
    public static function providesValue(): iterable
    {
        yield from PHPUnit::providesValue();
    }
}
