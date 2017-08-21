<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegulationApiTest extends TestCase
{
    use MakeRegulationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRegulation()
    {
        $regulation = $this->fakeRegulationData();
        $this->json('POST', '/api/v1/regulations', $regulation);

        $this->assertApiResponse($regulation);
    }

    /**
     * @test
     */
    public function testReadRegulation()
    {
        $regulation = $this->makeRegulation();
        $this->json('GET', '/api/v1/regulations/'.$regulation->id);

        $this->assertApiResponse($regulation->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRegulation()
    {
        $regulation = $this->makeRegulation();
        $editedRegulation = $this->fakeRegulationData();

        $this->json('PUT', '/api/v1/regulations/'.$regulation->id, $editedRegulation);

        $this->assertApiResponse($editedRegulation);
    }

    /**
     * @test
     */
    public function testDeleteRegulation()
    {
        $regulation = $this->makeRegulation();
        $this->json('DELETE', '/api/v1/regulations/'.$regulation->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/regulations/'.$regulation->id);

        $this->assertResponseStatus(404);
    }
}
