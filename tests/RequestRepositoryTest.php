<?php

use App\Models\Request;
use App\Repositories\RequestRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestRepositoryTest extends TestCase
{
    use MakeRequestTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RequestRepository
     */
    protected $requestRepo;

    public function setUp()
    {
        parent::setUp();
        $this->requestRepo = App::make(RequestRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRequest()
    {
        $request = $this->fakeRequestData();
        $createdRequest = $this->requestRepo->create($request);
        $createdRequest = $createdRequest->toArray();
        $this->assertArrayHasKey('id', $createdRequest);
        $this->assertNotNull($createdRequest['id'], 'Created Request must have id specified');
        $this->assertNotNull(Request::find($createdRequest['id']), 'Request with given id must be in DB');
        $this->assertModelData($request, $createdRequest);
    }

    /**
     * @test read
     */
    public function testReadRequest()
    {
        $request = $this->makeRequest();
        $dbRequest = $this->requestRepo->find($request->id);
        $dbRequest = $dbRequest->toArray();
        $this->assertModelData($request->toArray(), $dbRequest);
    }

    /**
     * @test update
     */
    public function testUpdateRequest()
    {
        $request = $this->makeRequest();
        $fakeRequest = $this->fakeRequestData();
        $updatedRequest = $this->requestRepo->update($fakeRequest, $request->id);
        $this->assertModelData($fakeRequest, $updatedRequest->toArray());
        $dbRequest = $this->requestRepo->find($request->id);
        $this->assertModelData($fakeRequest, $dbRequest->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRequest()
    {
        $request = $this->makeRequest();
        $resp = $this->requestRepo->delete($request->id);
        $this->assertTrue($resp);
        $this->assertNull(Request::find($request->id), 'Request should not exist in DB');
    }
}
