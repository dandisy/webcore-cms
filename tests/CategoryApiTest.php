<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryApiTest extends TestCase
{
    use MakeCategoryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCategory()
    {
        $category = $this->fakeCategoryData();
        $this->json('POST', '/api/v1/categories', $category);

        $this->assertApiResponse($category);
    }

    /**
     * @test
     */
    public function testReadCategory()
    {
        $category = $this->makeCategory();
        $this->json('GET', '/api/v1/categories/'.$category->id);

        $this->assertApiResponse($category->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCategory()
    {
        $category = $this->makeCategory();
        $editedCategory = $this->fakeCategoryData();

        $this->json('PUT', '/api/v1/categories/'.$category->id, $editedCategory);

        $this->assertApiResponse($editedCategory);
    }

    /**
     * @test
     */
    public function testDeleteCategory()
    {
        $category = $this->makeCategory();
        $this->json('DELETE', '/api/v1/categories/'.$category->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/categories/'.$category->id);

        $this->assertResponseStatus(404);
    }
}
