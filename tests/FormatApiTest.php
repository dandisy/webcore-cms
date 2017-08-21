<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FormatApiTest extends TestCase
{
    use MakeFormatTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFormat()
    {
        $format = $this->fakeFormatData();
        $this->json('POST', '/api/v1/formats', $format);

        $this->assertApiResponse($format);
    }

    /**
     * @test
     */
    public function testReadFormat()
    {
        $format = $this->makeFormat();
        $this->json('GET', '/api/v1/formats/'.$format->id);

        $this->assertApiResponse($format->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFormat()
    {
        $format = $this->makeFormat();
        $editedFormat = $this->fakeFormatData();

        $this->json('PUT', '/api/v1/formats/'.$format->id, $editedFormat);

        $this->assertApiResponse($editedFormat);
    }

    /**
     * @test
     */
    public function testDeleteFormat()
    {
        $format = $this->makeFormat();
        $this->json('DELETE', '/api/v1/formats/'.$format->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/formats/'.$format->id);

        $this->assertResponseStatus(404);
    }
}
