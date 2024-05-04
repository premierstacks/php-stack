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

namespace Premierstacks\PhpUtil\Types;

use Premierstacks\PhpUtil\Debug\Errorf;

class Resources
{
    public const string READABLE_MODES = '/r|a\+|ab\+|w\+|wb\+|x\+|xb\+|c\+|cb\+/';

    public const string WRITABLE_MODES = '/a|w|r\+|rb\+|rw|x|c/';

    /**
     * @param resource $resource
     */
    public static function end(mixed $resource): void
    {
        static::fseek($resource, 0, \SEEK_END);
    }

    /**
     * @param resource $resource
     */
    public static function fclose(mixed $resource): void
    {
        if (\fclose($resource) === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fclose', [$resource]));
        }
    }

    /**
     * @param resource $resource
     */
    public static function fdatasync(mixed $resource): void
    {
        if (\fdatasync($resource) === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fdatasync', [$resource]));
        }
    }

    /**
     * @param resource $resource
     */
    public static function feof(mixed $resource): bool
    {
        return \feof($resource);
    }

    /**
     * @param resource $resource
     */
    public static function fflush(mixed $resource): void
    {
        if (\fflush($resource) === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fflush', [$resource]));
        }
    }

    /**
     * @param resource $resource
     */
    public static function fgetc(mixed $resource): string
    {
        $char = \fgetc($resource);

        if ($char === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fgetc', [$resource]));
        }

        return $char;
    }

    /**
     * @param resource $resource
     * @param int<0, max>|null $length
     *
     * @return list<string>
     */
    public static function fgetcsv(mixed $resource, int|null $length = null, string $separator = ',', string $enclosure = '"', string $escape = '\\'): array
    {
        $fields = \fgetcsv($resource, $length, $separator, $enclosure, $escape);

        if ($fields === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fgetcsv', [$resource, $length, $separator, $enclosure, $escape]));
        }

        if ($fields === [null]) {
            return [];
        }

        /** @var list<string> */
        return $fields;
    }

    /**
     * @param resource $resource
     * @param int<0, max>|null $length
     */
    public static function fgets(mixed $resource, int|null $length = null): string
    {
        $line = \fgets($resource, $length);

        if ($line === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fgets', [$resource, $length]));
        }

        return $line;
    }

    /**
     * @param resource $resource
     */
    public static function filesize(mixed $resource): int|null
    {
        $stat = static::fstat($resource);

        if (\is_int($stat['size'])) {
            return $stat['size'];
        }

        return null;
    }

    /**
     * @param resource $resource
     * @param int<0, 7> $operation
     */
    public static function flock(mixed $resource, int $operation): bool
    {
        $locked = \flock($resource, $operation);

        if ($locked === false) {
            throw new \UnexpectedValueException(Errorf::callableError('flock', [$resource, $operation]));
        }

        return $locked;
    }

    /**
     * @param resource|null $context
     *
     * @return open-resource
     */
    public static function fopen(string $filename = 'php://temp/maxmemory:10485760', string $mode = 'r+', bool $useIncludePath = false, mixed $context = null): mixed
    {
        $resource = \fopen($filename, $mode, $useIncludePath, $context);

        if ($resource === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fopen', [$filename, $mode, $useIncludePath, $context]));
        }

        return $resource;
    }

    /**
     * @param resource $resource
     */
    public static function fpassthru(mixed $resource): int
    {
        return \fpassthru($resource);
    }

    /**
     * @param resource $resource
     */
    public static function fprintf(mixed $resource, string $format, bool|float|int|string|null ...$vars): int
    {
        return \fprintf($resource, $format, ...$vars);
    }

    /**
     * @param resource $resource
     * @param array<int|string, scalar|null> $fields
     */
    public static function fputcsv(mixed $resource, array $fields, string $separator = ',', string $enclosure = '"', string $escape = '\\', string $eol = \PHP_EOL): int
    {
        $written = \fputcsv($resource, $fields, $separator, $enclosure, $escape, $eol);

        if ($written === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fputcsv', [$resource, $fields, $separator, $enclosure, $escape, $eol]));
        }

        return $written;
    }

    /**
     * @param resource $resource
     * @param int<0, max> $length
     */
    public static function fread(mixed $resource, int $length): string
    {
        $data = \fread($resource, $length);

        if ($data === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fread', [$resource, $length]));
        }

        return $data;
    }

    /**
     * @param resource $resource
     */
    public static function fscanf(mixed $resource, string $format, float|int|string|null &...$vars): int
    {
        $result = \fscanf($resource, $format, ...$vars);

        if ($result === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fscanf', [$resource, $format, $vars]));
        }

        if ($result === null) {
            return 0;
        }

        if (\is_array($result)) {
            return \count($result);
        }

        return $result;
    }

    /**
     * @param resource $resource
     */
    public static function fseek(mixed $resource, int $offset, int $whence = \SEEK_SET): void
    {
        if (\fseek($resource, $offset, $whence) === -1) {
            throw new \UnexpectedValueException(Errorf::callableError('fseek', [$resource, $offset, $whence]));
        }
    }

    /**
     * @param resource $resource
     *
     * @return array<int|string, mixed>
     */
    public static function fstat(mixed $resource): array
    {
        $stat = \fstat($resource);

        if ($stat === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fstat', [$resource]));
        }

        return $stat;
    }

    /**
     * @param resource $resource
     */
    public static function fsync(mixed $resource): void
    {
        if (\fsync($resource) === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fsync', [$resource]));
        }
    }

    /**
     * @param resource $resource
     */
    public static function ftell(mixed $resource): int
    {
        $position = \ftell($resource);

        if ($position === false) {
            throw new \UnexpectedValueException(Errorf::callableError('ftell', [$resource]));
        }

        return $position;
    }

    /**
     * @param resource $resource
     * @param int<0, max> $size
     */
    public static function ftruncate(mixed $resource, int $size): void
    {
        if (\ftruncate($resource, $size) === false) {
            throw new \UnexpectedValueException(Errorf::callableError('ftruncate', [$resource, $size]));
        }
    }

    /**
     * @param resource $resource
     * @param int<0, max>|null $length
     */
    public static function fwrite(mixed $resource, string $string, int|null $length = null): int
    {
        $written = \fwrite($resource, $string, $length);

        if ($written === false) {
            throw new \UnexpectedValueException(Errorf::callableError('fwrite', [$resource, $string, $length]));
        }

        return $written;
    }

    /**
     * @param resource $resource
     */
    public static function isReadable(mixed $resource): bool
    {
        return Strings::pregMatch(self::READABLE_MODES, static::streamGetMetaData($resource)['mode']);
    }

    /**
     * @param resource $resource
     */
    public static function isSeekable(mixed $resource): bool
    {
        return static::streamGetMetaData($resource)['seekable'];
    }

    /**
     * @param resource $resource
     */
    public static function isWritable(mixed $resource): bool
    {
        return Strings::pregMatch(self::WRITABLE_MODES, static::streamGetMetaData($resource)['mode']);
    }

    /**
     * @return open-resource
     */
    public static function memory(): mixed
    {
        return static::fopen('php://memory', 'r+');
    }

    /**
     * @param resource $resource
     */
    public static function rewind(mixed $resource): void
    {
        if (\rewind($resource) === false) {
            throw new \UnexpectedValueException(Errorf::callableError('rewind', [$resource]));
        }
    }

    /**
     * @param resource $resource
     */
    public static function streamGetContents(mixed $resource, int|null $length = null, int $offset = -1): string
    {
        $contents = \stream_get_contents($resource, $length, $offset);

        if ($contents === false) {
            throw new \UnexpectedValueException(Errorf::callableError('stream_get_contents', [$resource, $length, $offset]));
        }

        return $contents;
    }

    /**
     * @param resource $resource
     *
     * @return array{timed_out: bool, blocked: bool, eof: bool, unread_bytes: int, stream_type: string, wrapper_type: string, wrapper_data: mixed, mode: string, seekable: bool, uri: string}
     */
    public static function streamGetMetaData(mixed $resource): array
    {
        return \stream_get_meta_data($resource);
    }

    /**
     * @return open-resource
     */
    public static function temp(int $maxMemory = 10_485_760): mixed
    {
        return static::fopen("php://temp/maxmemory:{$maxMemory}", 'r+');
    }

    /**
     * @return open-resource
     */
    public static function tmpfile(): mixed
    {
        $resource = \tmpfile();

        if ($resource === false) {
            throw new \UnexpectedValueException(Errorf::callableError('tmpfile', []));
        }

        return $resource;
    }
}
