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

namespace Premierstacks\PhpUtil\IO;

use Premierstacks\PhpUtil\Debug\Errorf;
use Premierstacks\PhpUtil\Types\Resources;
use Psr\Http\Message\StreamInterface;

class ResourceObject implements \Stringable, StreamInterface
{
    /**
     * @param resource $resource
     */
    public function __construct(public mixed $resource) {}

    public function __destruct()
    {
        if (\is_resource($this->resource)) {
            $this->fclose();
        }
    }

    #[\Override]
    public function __toString(): string
    {
        if ($this->isSeekable()) {
            return $this->streamGetContents(null, 0);
        }

        return $this->streamGetContents();
    }

    #[\Override]
    public function close(): void
    {
        $this->fclose();
    }

    /**
     * @param resource|null $resource
     *
     * @return resource
     */
    #[\Override]
    public function detach(mixed $resource = null): mixed
    {
        $detached = $this->resource;

        $this->setResource($resource ?? Resources::temp());

        return $detached;
    }

    public function end(): void
    {
        Resources::end($this->resource);
    }

    #[\Override]
    public function eof(): bool
    {
        return $this->feof();
    }

    public function fclose(): void
    {
        Resources::fclose($this->resource);
    }

    public function fdatasync(): void
    {
        Resources::fdatasync($this->resource);
    }

    public function feof(): bool
    {
        return Resources::feof($this->resource);
    }

    public function fflush(): void
    {
        Resources::fflush($this->resource);
    }

    public function fgetc(): string
    {
        return Resources::fgetc($this->resource);
    }

    /**
     * @param int<0, max>|null $length
     *
     * @return list<string>
     */
    public function fgetcsv(int|null $length = null, string $separator = ',', string $enclosure = '"', string $escape = '\\'): array
    {
        return Resources::fgetcsv($this->resource, $length, $separator, $enclosure, $escape);
    }

    /**
     * @param int<0, max>|null $length
     */
    public function fgets(int|null $length = null): string
    {
        return Resources::fgets($this->resource, $length);
    }

    public function filesize(): int|null
    {
        return Resources::filesize($this->resource);
    }

    /**
     * @param int<0, 7> $operation
     */
    public function flock(int $operation): bool
    {
        return Resources::flock($this->resource, $operation);
    }

    public function fpassthru(): int
    {
        return Resources::fpassthru($this->resource);
    }

    public function fprintf(string $format, bool|float|int|string|null ...$vars): int
    {
        return Resources::fprintf($this->resource, $format, ...$vars);
    }

    /**
     * @param array<int|string, scalar|null> $fields
     */
    public function fputcsv(array $fields, string $separator = ',', string $enclosure = '"', string $escape = '\\', string $eol = \PHP_EOL): int
    {
        return Resources::fputcsv($this->resource, $fields, $separator, $enclosure, $escape, $eol);
    }

    /**
     * @param int<0, max> $length
     */
    public function fread(int $length): string
    {
        return Resources::fread($this->resource, $length);
    }

    public function fscanf(string $format, float|int|string|null &...$vars): int
    {
        return Resources::fscanf($this->resource, $format, ...$vars);
    }

    public function fseek(int $offset, int $whence = \SEEK_SET): void
    {
        Resources::fseek($this->resource, $offset, $whence);
    }

    /**
     * @return array<int|string, mixed>
     */
    public function fstat(): array
    {
        return Resources::fstat($this->resource);
    }

    public function fsync(): void
    {
        Resources::fsync($this->resource);
    }

    public function ftell(): int
    {
        return Resources::ftell($this->resource);
    }

    /**
     * @param int<0, max> $size
     */
    public function ftruncate(int $size): void
    {
        Resources::ftruncate($this->resource, $size);
    }

    /**
     * @param int<0, max>|null $length
     */
    public function fwrite(string $string, int|null $length = null): int
    {
        return Resources::fwrite($this->resource, $string, $length);
    }

    #[\Override]
    public function getContents(): string
    {
        return $this->streamGetContents();
    }

    #[\Override]
    public function getMetadata(string|null $key = null): mixed
    {
        if ($key === null) {
            return $this->streamGetMetaData();
        }

        return $this->streamGetMetaData()[$key] ?? null;
    }

    /**
     * @return resource
     */
    public function getResource(): mixed
    {
        return $this->resource;
    }

    #[\Override]
    public function getSize(): int|null
    {
        return $this->filesize();
    }

    #[\Override]
    public function isReadable(): bool
    {
        return Resources::isReadable($this->resource);
    }

    #[\Override]
    public function isSeekable(): bool
    {
        return Resources::isSeekable($this->resource);
    }

    #[\Override]
    public function isWritable(): bool
    {
        return Resources::isWritable($this->resource);
    }

    #[\Override]
    public function read(int $length): string
    {
        if ($length < 0) {
            throw new \InvalidArgumentException(Errorf::invalidArgument('length', $length, 'int<0, max>'));
        }

        return $this->fread($length);
    }

    #[\Override]
    public function rewind(): void
    {
        Resources::rewind($this->resource);
    }

    #[\Override]
    public function seek(int $offset, int $whence = \SEEK_SET): void
    {
        $this->fseek($offset, $whence);
    }

    /**
     * @param resource $resource
     */
    public function setResource(mixed $resource): void
    {
        $this->resource = $resource;
    }

    public function streamGetContents(int|null $length = null, int $offset = -1): string
    {
        return Resources::streamGetContents($this->resource, $length, $offset);
    }

    /**
     * @return array{timed_out: bool, blocked: bool, eof: bool, unread_bytes: int, stream_type: string, wrapper_type: string, wrapper_data: mixed, mode: string, seekable: bool, uri: string}
     */
    public function streamGetMetaData(): array
    {
        return Resources::streamGetMetaData($this->resource);
    }

    #[\Override]
    public function tell(): int
    {
        return $this->ftell();
    }

    #[\Override]
    public function write(string $string): int
    {
        return $this->fwrite($string);
    }

    /**
     * @param resource|null $context
     */
    public static function newFromFile(string $filename = 'php://temp/maxmemory:10485760', string $mode = 'r+', bool $useIncludePath = false, mixed $context = null): self
    {
        return new self(Resources::fopen($filename, $mode, $useIncludePath, $context));
    }

    /**
     * @param resource $resource
     */
    public static function newFromResource(mixed $resource): self
    {
        return new self($resource);
    }

    public static function newFromString(string $content = ''): self
    {
        $self = new self(Resources::temp());

        if ($content !== '') {
            $self->write($content);
        }

        return $self;
    }
}
