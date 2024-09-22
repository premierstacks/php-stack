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

namespace Tests\Unit\Mixed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use Premierstacks\PhpStack\Mixed\Check;
use Premierstacks\PhpStack\Testing\PHPUnit;
use Premierstacks\PhpStack\Testing\TestIntEnum;
use Premierstacks\PhpStack\Testing\TestStringEnum;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Small]
#[CoversClass(Check::class)]
class CheckTest extends TestCase
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

        static::assertSame($value, Check::a($value, \stdClass::class));
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

        static::assertSame($value, Check::array($value));
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

        static::assertSame($value, Check::arrayKey($value));
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

        static::assertSame($value, Check::arrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::bool($value));
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

        static::assertSame($value, Check::callable($value));
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

        static::assertSame($value, Check::callableString($value));
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

        static::assertSame($value, Check::classString($value));
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

        static::assertSame($value, Check::closedResource($value));
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

        static::assertSame($value, Check::countable($value));
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

        static::assertSame($value, Check::enum($value, \BackedEnum::class));
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

        static::assertSame($value, Check::false($value));
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

        static::assertSame($value, Check::float($value));
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

        static::assertSame($value, Check::in($value, [true]));
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

        static::assertSame($value, Check::instance($value, \stdClass::class));
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

        static::assertSame($value, Check::int($value));
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

        static::assertSame($value, Check::intArray($value));
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

        static::assertSame($value, Check::intArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::intEnum($value, TestIntEnum::class));
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

        static::assertSame($value, Check::intIterable($value));
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

        static::assertSame($value, Check::intIterableOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::interfaceString($value));
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

        static::assertSame($value, Check::iterable($value));
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

        static::assertSame($value, Check::iterableOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::list($value));
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

        static::assertSame($value, Check::listOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::negativeInt($value));
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

        static::assertSame($value, Check::nonEmptyArray($value));
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

        static::assertSame($value, Check::nonEmptyArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nonEmptyIntArray($value));
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

        static::assertSame($value, Check::nonEmptyIntArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nonEmptyList($value));
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

        static::assertSame($value, Check::nonEmptyListOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nonEmptyString($value));
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

        static::assertSame($value, Check::nonEmptyStringArray($value));
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

        static::assertSame($value, Check::nonEmptyStringArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nonFalsyString($value));
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

        static::assertSame($value, Check::nonNegativeInt($value));
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

        static::assertSame($value, Check::nonPositiveInt($value));
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

        static::assertSame($value, Check::nonZeroInt($value));
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

        static::assertSame($value, Check::notFalse($value));
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

        static::assertSame($value, Check::notNegativeOne($value));
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

        static::assertSame($value, Check::notNull($value));
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

        static::assertSame($value, Check::notPositiveOne($value));
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

        static::assertSame($value, Check::notTrue($value));
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

        static::assertSame($value, Check::notZero($value));
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

        static::assertSame($value, Check::null($value));
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

        static::assertSame($value, Check::nullableA($value, \stdClass::class));
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

        static::assertSame($value, Check::nullableArray($value));
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

        static::assertSame($value, Check::nullableArrayKey($value));
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

        static::assertSame($value, Check::nullableArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableBool($value));
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

        static::assertSame($value, Check::nullableCallable($value));
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

        static::assertSame($value, Check::nullableCallableString($value));
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

        static::assertSame($value, Check::nullableClassString($value));
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

        static::assertSame($value, Check::nullableClosedResource($value));
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

        static::assertSame($value, Check::nullableCountable($value));
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

        static::assertSame($value, Check::nullableEnum($value, \BackedEnum::class));
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

        static::assertSame($value, Check::nullableFalse($value));
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

        static::assertSame($value, Check::nullableFloat($value));
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

        static::assertSame($value, Check::nullableIn($value, [true]));
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

        static::assertSame($value, Check::nullableInstance($value, \stdClass::class));
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

        static::assertSame($value, Check::nullableInt($value));
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

        static::assertSame($value, Check::nullableIntArray($value));
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

        static::assertSame($value, Check::nullableIntArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableIntEnum($value, TestIntEnum::class));
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

        static::assertSame($value, Check::nullableIntIterable($value));
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

        static::assertSame($value, Check::nullableIntIterableOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableInterfaceString($value));
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

        static::assertSame($value, Check::nullableIterable($value));
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

        static::assertSame($value, Check::nullableIterableOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableList($value));
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

        static::assertSame($value, Check::nullableListOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableNegativeInt($value));
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

        static::assertSame($value, Check::nullableNonEmptyArray($value));
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

        static::assertSame($value, Check::nullableNonEmptyArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableNonEmptyIntArray($value));
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

        static::assertSame($value, Check::nullableNonEmptyIntArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableNonEmptyList($value));
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

        static::assertSame($value, Check::nullableNonEmptyListOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableNonEmptyString($value));
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

        static::assertSame($value, Check::nullableNonEmptyStringArray($value));
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

        static::assertSame($value, Check::nullableNonEmptyStringArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableNonFalsyString($value));
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

        static::assertSame($value, Check::nullableNonNegativeInt($value));
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

        static::assertSame($value, Check::nullableNonPositiveInt($value));
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

        static::assertSame($value, Check::nullableNonZeroInt($value));
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

        static::assertSame($value, Check::nullableNumeric($value));
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

        static::assertSame($value, Check::nullableNumericString($value));
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

        static::assertSame($value, Check::nullableObject($value));
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

        static::assertSame($value, Check::nullableOpenResource($value));
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

        static::assertSame($value, Check::nullablePositiveInt($value));
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

        static::assertSame($value, Check::nullableResource($value));
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

        static::assertSame($value, Check::nullableScalar($value));
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

        static::assertSame($value, Check::nullableString($value));
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

        static::assertSame($value, Check::nullableStringArray($value));
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

        static::assertSame($value, Check::nullableStringArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableStringEnum($value, TestStringEnum::class));
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

        static::assertSame($value, Check::nullableStringIterable($value));
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

        static::assertSame($value, Check::nullableStringIterableOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::nullableStringable($value));
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

        static::assertSame($value, Check::nullableTraitString($value));
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

        static::assertSame($value, Check::nullableTrue($value));
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

        static::assertSame($value, Check::numeric($value));
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

        static::assertSame($value, Check::numericString($value));
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

        static::assertSame($value, Check::object($value));
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

        static::assertSame($value, Check::openResource($value));
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

        static::assertSame($value, Check::positiveInt($value));
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

        static::assertSame($value, Check::resource($value));
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

        static::assertSame($value, Check::scalar($value));
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

        static::assertSame($value, Check::string($value));
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

        static::assertSame($value, Check::stringArray($value));
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

        static::assertSame($value, Check::stringArrayOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::stringEnum($value, TestStringEnum::class));
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

        static::assertSame($value, Check::stringIterable($value));
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

        static::assertSame($value, Check::stringIterableOf($value, static fn(int|string $key, mixed $value): mixed => $value));
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

        static::assertSame($value, Check::stringable($value));
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

        static::assertSame($value, Check::traitString($value));
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

        static::assertSame($value, Check::true($value));
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
