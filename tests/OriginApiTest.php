<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OriginApiTest extends TestCase
{
    use MakeOriginTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOrigin()
    {
        $origin = $this->fakeOriginData();
        $this->json('POST', '/api/v1/origins', $origin);

        $this->assertApiResponse($origin);
    }

    /**
     * @test
     */
    public function testReadOrigin()
    {
        $origin = $this->makeOrigin();
        $this->json('GET', '/api/v1/origins/'.$origin->id);

        $this->assertApiResponse($origin->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOrigin()
    {
        $origin = $this->makeOrigin();
        $editedOrigin = $this->fakeOriginData();

        $this->json('PUT', '/api/v1/origins/'.$origin->id, $editedOrigin);

        $this->assertApiResponse($editedOrigin);
    }

    /**
     * @test
     */
    public function testDeleteOrigin()
    {
        $origin = $this->makeOrigin();
        $this->json('DELETE', '/api/v1/origins/'.$origin->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/origins/'.$origin->id);

        $this->assertResponseStatus(404);
    }
}
