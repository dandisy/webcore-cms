<?php

use App\Models\Type;
use App\Repositories\TypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TypeRepositoryTest extends TestCase
{
    use MakeTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TypeRepository
     */
    protected $typeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->typeRepo = App::make(TypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateType()
    {
        $type = $this->fakeTypeData();
        $createdType = $this->typeRepo->create($type);
        $createdType = $createdType->toArray();
        $this->assertArrayHasKey('id', $createdType);
        $this->assertNotNull($createdType['id'], 'Created Type must have id specified');
        $this->assertNotNull(Type::find($createdType['id']), 'Type with given id must be in DB');
        $this->assertModelData($type, $createdType);
    }

    /**
     * @test read
     */
    public function testReadType()
    {
        $type = $this->makeType();
        $dbType = $this->typeRepo->find($type->id);
        $dbType = $dbType->toArray();
        $this->assertModelData($type->toArray(), $dbType);
    }

    /**
     * @test update
     */
    public function testUpdateType()
    {
        $type = $this->makeType();
        $fakeType = $this->fakeTypeData();
        $updatedType = $this->typeRepo->update($fakeType, $type->id);
        $this->assertModelData($fakeType, $updatedType->toArray());
        $dbType = $this->typeRepo->find($type->id);
        $this->assertModelData($fakeType, $dbType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteType()
    {
        $type = $this->makeType();
        $resp = $this->typeRepo->delete($type->id);
        $this->assertTrue($resp);
        $this->assertNull(Type::find($type->id), 'Type should not exist in DB');
    }
}
