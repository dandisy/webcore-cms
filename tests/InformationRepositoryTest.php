<?php

use App\Models\Information;
use App\Repositories\InformationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InformationRepositoryTest extends TestCase
{
    use MakeInformationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InformationRepository
     */
    protected $informationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->informationRepo = App::make(InformationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInformation()
    {
        $information = $this->fakeInformationData();
        $createdInformation = $this->informationRepo->create($information);
        $createdInformation = $createdInformation->toArray();
        $this->assertArrayHasKey('id', $createdInformation);
        $this->assertNotNull($createdInformation['id'], 'Created Information must have id specified');
        $this->assertNotNull(Information::find($createdInformation['id']), 'Information with given id must be in DB');
        $this->assertModelData($information, $createdInformation);
    }

    /**
     * @test read
     */
    public function testReadInformation()
    {
        $information = $this->makeInformation();
        $dbInformation = $this->informationRepo->find($information->id);
        $dbInformation = $dbInformation->toArray();
        $this->assertModelData($information->toArray(), $dbInformation);
    }

    /**
     * @test update
     */
    public function testUpdateInformation()
    {
        $information = $this->makeInformation();
        $fakeInformation = $this->fakeInformationData();
        $updatedInformation = $this->informationRepo->update($fakeInformation, $information->id);
        $this->assertModelData($fakeInformation, $updatedInformation->toArray());
        $dbInformation = $this->informationRepo->find($information->id);
        $this->assertModelData($fakeInformation, $dbInformation->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInformation()
    {
        $information = $this->makeInformation();
        $resp = $this->informationRepo->delete($information->id);
        $this->assertTrue($resp);
        $this->assertNull(Information::find($information->id), 'Information should not exist in DB');
    }
}
