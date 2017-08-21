<?php

use App\Models\Origin;
use App\Repositories\OriginRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OriginRepositoryTest extends TestCase
{
    use MakeOriginTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OriginRepository
     */
    protected $originRepo;

    public function setUp()
    {
        parent::setUp();
        $this->originRepo = App::make(OriginRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOrigin()
    {
        $origin = $this->fakeOriginData();
        $createdOrigin = $this->originRepo->create($origin);
        $createdOrigin = $createdOrigin->toArray();
        $this->assertArrayHasKey('id', $createdOrigin);
        $this->assertNotNull($createdOrigin['id'], 'Created Origin must have id specified');
        $this->assertNotNull(Origin::find($createdOrigin['id']), 'Origin with given id must be in DB');
        $this->assertModelData($origin, $createdOrigin);
    }

    /**
     * @test read
     */
    public function testReadOrigin()
    {
        $origin = $this->makeOrigin();
        $dbOrigin = $this->originRepo->find($origin->id);
        $dbOrigin = $dbOrigin->toArray();
        $this->assertModelData($origin->toArray(), $dbOrigin);
    }

    /**
     * @test update
     */
    public function testUpdateOrigin()
    {
        $origin = $this->makeOrigin();
        $fakeOrigin = $this->fakeOriginData();
        $updatedOrigin = $this->originRepo->update($fakeOrigin, $origin->id);
        $this->assertModelData($fakeOrigin, $updatedOrigin->toArray());
        $dbOrigin = $this->originRepo->find($origin->id);
        $this->assertModelData($fakeOrigin, $dbOrigin->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOrigin()
    {
        $origin = $this->makeOrigin();
        $resp = $this->originRepo->delete($origin->id);
        $this->assertTrue($resp);
        $this->assertNull(Origin::find($origin->id), 'Origin should not exist in DB');
    }
}
