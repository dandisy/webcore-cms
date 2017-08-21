<?php

use App\Models\Regulation;
use App\Repositories\RegulationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegulationRepositoryTest extends TestCase
{
    use MakeRegulationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RegulationRepository
     */
    protected $regulationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->regulationRepo = App::make(RegulationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRegulation()
    {
        $regulation = $this->fakeRegulationData();
        $createdRegulation = $this->regulationRepo->create($regulation);
        $createdRegulation = $createdRegulation->toArray();
        $this->assertArrayHasKey('id', $createdRegulation);
        $this->assertNotNull($createdRegulation['id'], 'Created Regulation must have id specified');
        $this->assertNotNull(Regulation::find($createdRegulation['id']), 'Regulation with given id must be in DB');
        $this->assertModelData($regulation, $createdRegulation);
    }

    /**
     * @test read
     */
    public function testReadRegulation()
    {
        $regulation = $this->makeRegulation();
        $dbRegulation = $this->regulationRepo->find($regulation->id);
        $dbRegulation = $dbRegulation->toArray();
        $this->assertModelData($regulation->toArray(), $dbRegulation);
    }

    /**
     * @test update
     */
    public function testUpdateRegulation()
    {
        $regulation = $this->makeRegulation();
        $fakeRegulation = $this->fakeRegulationData();
        $updatedRegulation = $this->regulationRepo->update($fakeRegulation, $regulation->id);
        $this->assertModelData($fakeRegulation, $updatedRegulation->toArray());
        $dbRegulation = $this->regulationRepo->find($regulation->id);
        $this->assertModelData($fakeRegulation, $dbRegulation->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRegulation()
    {
        $regulation = $this->makeRegulation();
        $resp = $this->regulationRepo->delete($regulation->id);
        $this->assertTrue($resp);
        $this->assertNull(Regulation::find($regulation->id), 'Regulation should not exist in DB');
    }
}
