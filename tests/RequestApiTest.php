<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestApiTest extends TestCase
{
    use MakeRequestTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRequest()
    {
        $request = $this->fakeRequestData();
        $this->json('POST', '/api/v1/requests', $request);

        $this->assertApiResponse($request);
    }

    /**
     * @test
     */
    public function testReadRequest()
    {
        $request = $this->makeRequest();
        $this->json('GET', '/api/v1/requests/'.$request->id);

        $this->assertApiResponse($request->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRequest()
    {
        $request = $this->makeRequest();
        $editedRequest = $this->fakeRequestData();

        $this->json('PUT', '/api/v1/requests/'.$request->id, $editedRequest);

        $this->assertApiResponse($editedRequest);
    }

    /**
     * @test
     */
    public function testDeleteRequest()
    {
        $request = $this->makeRequest();
        $this->json('DELETE', '/api/v1/requests/'.$request->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/requests/'.$request->id);

        $this->assertResponseStatus(404);
    }
}
