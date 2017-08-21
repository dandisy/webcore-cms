<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArchiveApiTest extends TestCase
{
    use MakeArchiveTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateArchive()
    {
        $archive = $this->fakeArchiveData();
        $this->json('POST', '/api/v1/archives', $archive);

        $this->assertApiResponse($archive);
    }

    /**
     * @test
     */
    public function testReadArchive()
    {
        $archive = $this->makeArchive();
        $this->json('GET', '/api/v1/archives/'.$archive->id);

        $this->assertApiResponse($archive->toArray());
    }

    /**
     * @test
     */
    public function testUpdateArchive()
    {
        $archive = $this->makeArchive();
        $editedArchive = $this->fakeArchiveData();

        $this->json('PUT', '/api/v1/archives/'.$archive->id, $editedArchive);

        $this->assertApiResponse($editedArchive);
    }

    /**
     * @test
     */
    public function testDeleteArchive()
    {
        $archive = $this->makeArchive();
        $this->json('DELETE', '/api/v1/archives/'.$archive->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/archives/'.$archive->id);

        $this->assertResponseStatus(404);
    }
}
