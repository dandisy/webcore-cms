<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TypeApiTest extends TestCase
{
    use MakeTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateType()
    {
        $type = $this->fakeTypeData();
        $this->json('POST', '/api/v1/types', $type);

        $this->assertApiResponse($type);
    }

    /**
     * @test
     */
    public function testReadType()
    {
        $type = $this->makeType();
        $this->json('GET', '/api/v1/types/'.$type->id);

        $this->assertApiResponse($type->toArray());
    }

    /**
     * @test
     */
    public function testUpdateType()
    {
        $type = $this->makeType();
        $editedType = $this->fakeTypeData();

        $this->json('PUT', '/api/v1/types/'.$type->id, $editedType);

        $this->assertApiResponse($editedType);
    }

    /**
     * @test
     */
    public function testDeleteType()
    {
        $type = $this->makeType();
        $this->json('DELETE', '/api/v1/types/'.$type->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/types/'.$type->id);

        $this->assertResponseStatus(404);
    }
}
