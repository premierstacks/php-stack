<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025, Tomáš Chochola <chocholatom1997@gmail.com>. Some rights reserved.
 *
 * @license CC-BY-ND-4.0
 *
 * @see {@link https://creativecommons.org/licenses/by-nd/4.0/} License
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
 */

declare(strict_types=1);

namespace Premierstacks\PhpStack\Testing;

use PHPUnit\Framework\Assert;
use Premierstacks\PhpStack\Types\Resources;

class PHPUnit extends Assert
{
    /**
     * @template T
     *
     * @param callable(mixed): T $callable
     *
     * @phpstan-assert T $actual
     *
     * @psalm-assert T $actual
     */
    public static function assertType(mixed $actual, callable $callable, string $message = ''): void
    {
        static::assertEquals($actual, $callable($actual), $message);
    }

    /**
     * @return iterable<string, array{mixed, list<string>}>
     */
    public static function providesValue(): iterable
    {
        $openResource = Resources::memory();
        $closedResource = Resources::memory();

        Resources::fclose($closedResource);

        yield 'null' => [
            null,
            ['null'],
        ];

        yield 'null-string' => [
            'null',
            ['null-string', 'string', 'non-falsy-string', 'scalar', 'non-empty-string', 'stringable'],
        ];

        yield 'true' => [
            true,
            ['true', 'bool', 'scalar', 'stringable'],
        ];

        yield 'true-string' => [
            'true',
            ['true-string', 'string', 'non-falsy-string', 'bool-string', 'scalar', 'non-empty-string', 'stringable'],
        ];

        yield 'yes-string' => [
            'yes',
            ['yes-string', 'string', 'non-falsy-string', 'bool-string', 'scalar', 'non-empty-string', 'stringable'],
        ];

        yield 'on-string' => [
            'on',
            ['on-string', 'string', 'non-falsy-string', 'bool-string', 'scalar', 'non-empty-string', 'stringable'],
        ];

        yield '1-string' => [
            '1',
            ['1-string', 'string', 'non-falsy-string', 'bool-string', 'scalar', 'numeric-string', 'numeric', 'non-empty-string', 'positive-numeric', 'non-negative-numeric', 'non-zero-numeric', 'stringable'],
        ];

        yield 'false' => [
            false,
            ['false', 'bool', 'scalar', 'stringable'],
        ];

        yield 'false-string' => [
            'false',
            ['false-string', 'string', 'bool-string', 'scalar', 'non-empty-string', 'non-falsy-string', 'stringable'],
        ];

        yield 'no-string' => [
            'no',
            ['no-string', 'string', 'bool-string', 'scalar', 'non-empty-string', 'non-falsy-string', 'stringable'],
        ];

        yield 'off-string' => [
            'off',
            ['off-string', 'string', 'bool-string', 'scalar', 'non-empty-string', 'non-falsy-string', 'stringable'],
        ];

        yield '0-string' => [
            '0',
            ['0-string', 'string', 'bool-string', 'scalar', 'numeric-string', 'numeric', 'non-empty-string', 'non-negative-numeric', 'non-positive-numeric', 'zero-numeric', 'stringable'],
        ];

        yield '0-int' => [
            0,
            ['0-int', 'int', 'numeric', 'non-negative-int', 'scalar', 'non-positive-int', 'zero-int', 'non-negative-numeric', 'non-positive-numeric', 'zero-numeric', 'stringable'],
        ];

        yield '5-int' => [
            5,
            ['5-int', 'int', 'numeric', 'positive-int', 'scalar', 'non-negative-int', 'non-zero-int', 'non-negative-numeric', 'non-zero-numeric', 'stringable'],
        ];

        yield '-5-int' => [
            -5,
            ['-5-int', 'int', 'numeric', 'negative-int', 'scalar', 'non-positive-int', 'non-zero-int', 'non-positive-numeric', 'non-zero-numeric', 'stringable'],
        ];

        yield '5-string' => [
            '5',
            ['5-string', 'int-string', 'string', 'numeric-string', 'numeric', 'scalar', 'non-falsy-string', 'non-empty-string', 'positive-numeric', 'non-negative-numeric', 'non-zero-numeric', 'stringable'],
        ];

        yield '-5-string' => [
            '-5',
            ['-5-string', 'int-string', 'string', 'numeric-string', 'numeric', 'scalar', 'non-falsy-string', 'non-empty-string', 'negative-numeric', 'non-positive-numeric', 'non-zero-numeric', 'stringable'],
        ];

        yield '5.5-float' => [
            5.5,
            ['5.5-float', 'float', 'numeric', 'scalar', 'stringable'],
        ];

        yield '5.5-string' => [
            '5.5',
            ['5.5-string', 'float-string', 'string', 'numeric-string', 'numeric', 'scalar', 'non-falsy-string', 'non-empty-string', 'stringable'],
        ];

        yield '-5.5-float' => [
            -5.5,
            ['-5.5-float', 'float', 'numeric', 'scalar', 'stringable'],
        ];

        yield '-5.5-string' => [
            '-5.5',
            ['-5.5-string', 'float-string', 'string', 'numeric-string', 'numeric', 'scalar', 'non-falsy-string', 'non-empty-string', 'stringable'],
        ];

        yield 'string-string' => [
            'string',
            ['string', 'non-falsy-string', 'scalar', 'non-empty-string', 'stringable'],
        ];

        yield 'empty-string' => [
            '',
            ['empty-string', 'string', 'scalar', 'stringable'],
        ];

        yield 'empty-array' => [
            [],
            ['empty-array', 'array', 'list', 'int-array', 'string-array', 'iterable', 'int-iterable', 'string-iterable', 'countable'],
        ];

        yield 'array' => [
            [5, 5 => 5, 'string' => 'string'],
            ['array', 'non-empty-array', 'iterable', 'countable'],
        ];

        yield 'list' => [
            [5],
            ['list', 'array', 'non-empty-array', 'non-empty-list', 'int-array', 'iterable', 'int-iterable', 'non-empty-int-array', 'countable'],
        ];

        yield 'int-array' => [
            [5, 5 => 5],
            ['int-array', 'array', 'non-empty-array', 'iterable', 'int-iterable', 'non-empty-int-array', 'countable'],
        ];

        yield 'string-array' => [
            ['string' => 'string'],
            ['string-array', 'array', 'non-empty-array', 'iterable', 'string-iterable', 'non-empty-string-array', 'countable'],
        ];

        yield 'std-object' => [
            new \stdClass(),
            ['object', 'std-object'],
        ];

        yield 'std-class-string' => [
            \stdClass::class,
            ['class-string', 'string', 'non-falsy-string', 'scalar', 'non-empty-string', 'std-class-string', 'stringable'],
        ];

        yield 'interface-string' => [
            TestInterface::class,
            ['interface-string', 'string', 'non-falsy-string', 'scalar', 'non-empty-string', 'stringable'],
        ];

        yield 'trait-string' => [
            TestTrait::class,
            ['trait-string', 'string', 'non-falsy-string', 'scalar', 'non-empty-string', 'stringable'],
        ];

        yield 'open-resource' => [
            $openResource,
            ['resource', 'open-resource'],
        ];

        yield 'closed-resource' => [
            $closedResource,
            ['closed-resource', 'resource'],
        ];

        yield 'closure-callable' => [
            static fn(): mixed => null,
            ['callable', 'object', 'closure'],
        ];

        yield 'callable-string' => [
            'trim',
            ['callable-string', 'string', 'non-falsy-string', 'scalar', 'non-empty-string', 'callable', 'stringable'],
        ];

        yield 'empty-iterable' => [
            new \ArrayIterator([]),
            ['empty-iterable', 'iterable', 'object', 'int-iterable', 'string-iterable', 'countable'],
        ];

        yield 'iterable' => [
            new \ArrayIterator([5, 5 => 5, 'string' => 'string']),
            ['iterable', 'object', 'countable'],
        ];

        yield 'int-iterable' => [
            new \ArrayIterator([5 => 5]),
            ['int-iterable', 'iterable', 'object', 'countable'],
        ];

        yield 'string-iterable' => [
            new \ArrayIterator(['string' => 'string']),
            ['string-iterable', 'iterable', 'object', 'countable'],
        ];

        yield 'int-enum' => [
            TestIntEnum::Case,
            ['enum', 'object', 'test-int-enum', 'int-enum'],
        ];

        yield 'string-enum' => [
            TestStringEnum::Case,
            ['enum', 'object', 'test-string-enum', 'string-enum'],
        ];
    }
}
