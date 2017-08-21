<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InformationApiTest extends TestCase
{
    use MakeInformationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInformation()
    {
        $information = $this->fakeInformationData();
        $this->json('POST', '/api/v1/information', $information);

        $this->assertApiResponse($information);
    }

    /**
     * @test
     */
    public function testReadInformation()
    {
        $information = $this->makeInformation();
        $this->json('GET', '/api/v1/information/'.$information->id);

        $this->assertApiResponse($information->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInformation()
    {
        $information = $this->makeInformation();
        $editedInformation = $this->fakeInformationData();

        $this->json('PUT', '/api/v1/information/'.$information->id, $editedInformation);

        $this->assertApiResponse($editedInformation);
    }

    /**
     * @test
     */
    public function testDeleteInformation()
    {
        $information = $this->makeInformation();
        $this->json('DELETE', '/api/v1/information/'.$information->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/information/'.$information->id);

        $this->assertResponseStatus(404);
    }
}
