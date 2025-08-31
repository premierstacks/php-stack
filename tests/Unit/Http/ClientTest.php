<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright © 2025 Tomáš Chochola <chocholatom1997@gmail.com>
 *
 * @license CC-BY-ND-4.0
 *
 * @see {@link https://creativecommons.org/licenses/by-nd/4.0/} License
 * @see {@link https://github.com/tomchochola} GitHub Personal
 * @see {@link https://github.com/premierstacks} GitHub Organization
 * @see {@link https://github.com/sponsors/tomchochola} GitHub Sponsors
 */

declare(strict_types=1);

namespace Tests\Unit\Http;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\Test;
use Premierstacks\PhpStack\Http\Client;
use Premierstacks\PhpStack\Http\Request;
use Premierstacks\PhpStack\Http\Response;
use Premierstacks\PhpStack\Http\Stream;
use Premierstacks\PhpStack\Http\Uri;
use Symfony\Component\Mime\Header\HeaderInterface;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Tests\Unit\TestCase;

/**
 * @internal
 */
#[Medium]
#[CoversClass(Client::class)]
class ClientTest extends TestCase
{
    #[Test]
    public function testCreateRequest(): void
    {
        $request = $this->client()->createRequest('GET', 'https://user:password@localhost:80/path?query=query#fragment');

        static::assertInstanceOf(Request::class, $request);
        static::assertSame('GET', $request->getMethod());
        static::assertSame('https://user:password@localhost:80/path?query=query#fragment', $request->getUri()->__toString());
    }

    #[Test]
    public function testCreateResponse(): void
    {
        $response = $this->client()->createResponse(200, 'OK');

        static::assertInstanceOf(Response::class, $response);
        static::assertSame(200, $response->getStatusCode());
        static::assertSame('OK', $response->getReasonPhrase());
    }

    #[Test]
    public function testCreateStream(): void
    {
        $stream = $this->client()->createStream('test');

        static::assertInstanceOf(Stream::class, $stream);
        static::assertSame('test', $stream->__toString());
    }

    #[Test]
    public function testCreateStreamFromFile(): void
    {
        $stream = $this->client()->createStreamFromFile($this->tempfile());

        static::assertInstanceOf(Stream::class, $stream);
        static::assertSame('test', $stream->__toString());
    }

    #[Test]
    public function testCreateStreamFromResource(): void
    {
        $stream = $this->client()->createStreamFromResource($this->resource());

        static::assertInstanceOf(Stream::class, $stream);
        static::assertSame('test', $stream->__toString());
    }

    #[Test]
    public function testCreateUri(): void
    {
        $uri = $this->client()->createUri('https://user:password@localhost:80/path?query=query#fragment');

        static::assertInstanceOf(Uri::class, $uri);
        static::assertSame('https://user:password@localhost:80/path?query=query#fragment', $uri->__toString());
    }

    #[Test]
    public function testSendRequest(): void
    {
        $request = $this->client()->createRequest('GET', 'https://httpbin.org/base64/' . \base64_encode('test'));

        $request = $request->withHeader('accept', '*/*');

        $response = $this->client()->sendRequest($request);

        static::assertInstanceOf(Response::class, $response);
        static::assertSame(200, $response->getStatusCode());
        static::assertSame('OK', $response->getReasonPhrase());
        static::assertSame('test', $response->getBody()->__toString());
    }

    #[Test]
    public function testSendRequestJson(): void
    {
        $request = $this->client()->createRequest('GET', 'https://httpbin.org/anything');

        $request = $request->withHeader('content-type', 'application/json');
        $request = $request->withHeader('accept', 'application/json');

        $json = \json_encode(['test' => 'test']);

        static::assertIsString($json);

        $request = $request->withBody($this->client()->createStream($json));

        $response = $this->client()->sendRequest($request);

        static::assertInstanceOf(Response::class, $response);
        static::assertSame(200, $response->getStatusCode());
        static::assertSame('OK', $response->getReasonPhrase());

        $array = \json_decode($response->getBody()->__toString(), true);

        static::assertIsArray($array);

        $data = $array['data'] ?? throw new \LogicException('Data not found');

        static::assertIsString($data);

        static::assertJsonStringEqualsJsonString($json, $data);
    }

    #[Test]
    public function testSendRequestMultiPartFormData(): void
    {
        $request = $this->client()->createRequest('POST', 'https://httpbin.org/anything');

        $request = $request->withHeader('accept', 'application/json');

        $multipart = new FormDataPart(['test' => new DataPart('test', 'test.txt', 'text/plain')]);

        foreach ($multipart->getPreparedHeaders()->all() as $v) {
            static::assertInstanceOf(HeaderInterface::class, $v);

            $request = $request->withHeader($v->getName(), $v->getBodyAsString());
        }

        $request = $request->withBody($this->client()->createStream($multipart->bodyToString()));

        $response = $this->client()->sendRequest($request);

        static::assertInstanceOf(Response::class, $response);
        static::assertSame(200, $response->getStatusCode());
        static::assertSame('OK', $response->getReasonPhrase());

        $array = \json_decode($response->getBody()->__toString(), true);

        static::assertIsArray($array);

        $files = $array['files'] ?? throw new \LogicException('Files not found');

        static::assertIsArray($files);
        static::assertArrayHasKey('test', $files);

        static::assertSame('test', $files['test']);
    }

    #[Test]
    public function testSendRequestXWwwFormUrlencoded(): void
    {
        $request = $this->client()->createRequest('POST', 'https://httpbin.org/anything');

        $request = $request->withHeader('content-type', 'application/x-www-form-urlencoded');
        $request = $request->withHeader('accept', 'application/json');

        $body = \http_build_query(['test' => 'test']);

        $request = $request->withBody($this->client()->createStream($body));

        $response = $this->client()->sendRequest($request);

        static::assertInstanceOf(Response::class, $response);
        static::assertSame(200, $response->getStatusCode());
        static::assertSame('OK', $response->getReasonPhrase());

        $array = \json_decode($response->getBody()->__toString(), true);

        static::assertIsArray($array);

        $form = $array['form'] ?? throw new \LogicException('Form not found');

        static::assertIsArray($form);

        static::assertSame(['test' => 'test'], $form);
    }
}
