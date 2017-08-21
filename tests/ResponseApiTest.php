<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResponseApiTest extends TestCase
{
    use MakeResponseTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateResponse()
    {
        $response = $this->fakeResponseData();
        $this->json('POST', '/api/v1/responses', $response);

        $this->assertApiResponse($response);
    }

    /**
     * @test
     */
    public function testReadResponse()
    {
        $response = $this->makeResponse();
        $this->json('GET', '/api/v1/responses/'.$response->id);

        $this->assertApiResponse($response->toArray());
    }

    /**
     * @test
     */
    public function testUpdateResponse()
    {
        $response = $this->makeResponse();
        $editedResponse = $this->fakeResponseData();

        $this->json('PUT', '/api/v1/responses/'.$response->id, $editedResponse);

        $this->assertApiResponse($editedResponse);
    }

    /**
     * @test
     */
    public function testDeleteResponse()
    {
        $response = $this->makeResponse();
        $this->json('DELETE', '/api/v1/responses/'.$response->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/responses/'.$response->id);

        $this->assertResponseStatus(404);
    }
}
