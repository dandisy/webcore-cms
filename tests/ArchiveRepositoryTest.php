<?php

use App\Models\Archive;
use App\Repositories\ArchiveRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArchiveRepositoryTest extends TestCase
{
    use MakeArchiveTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ArchiveRepository
     */
    protected $archiveRepo;

    public function setUp()
    {
        parent::setUp();
        $this->archiveRepo = App::make(ArchiveRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateArchive()
    {
        $archive = $this->fakeArchiveData();
        $createdArchive = $this->archiveRepo->create($archive);
        $createdArchive = $createdArchive->toArray();
        $this->assertArrayHasKey('id', $createdArchive);
        $this->assertNotNull($createdArchive['id'], 'Created Archive must have id specified');
        $this->assertNotNull(Archive::find($createdArchive['id']), 'Archive with given id must be in DB');
        $this->assertModelData($archive, $createdArchive);
    }

    /**
     * @test read
     */
    public function testReadArchive()
    {
        $archive = $this->makeArchive();
        $dbArchive = $this->archiveRepo->find($archive->id);
        $dbArchive = $dbArchive->toArray();
        $this->assertModelData($archive->toArray(), $dbArchive);
    }

    /**
     * @test update
     */
    public function testUpdateArchive()
    {
        $archive = $this->makeArchive();
        $fakeArchive = $this->fakeArchiveData();
        $updatedArchive = $this->archiveRepo->update($fakeArchive, $archive->id);
        $this->assertModelData($fakeArchive, $updatedArchive->toArray());
        $dbArchive = $this->archiveRepo->find($archive->id);
        $this->assertModelData($fakeArchive, $dbArchive->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteArchive()
    {
        $archive = $this->makeArchive();
        $resp = $this->archiveRepo->delete($archive->id);
        $this->assertTrue($resp);
        $this->assertNull(Archive::find($archive->id), 'Archive should not exist in DB');
    }
}
