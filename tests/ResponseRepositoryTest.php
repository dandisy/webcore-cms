<?php

use App\Models\Response;
use App\Repositories\ResponseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResponseRepositoryTest extends TestCase
{
    use MakeResponseTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ResponseRepository
     */
    protected $responseRepo;

    public function setUp()
    {
        parent::setUp();
        $this->responseRepo = App::make(ResponseRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateResponse()
    {
        $response = $this->fakeResponseData();
        $createdResponse = $this->responseRepo->create($response);
        $createdResponse = $createdResponse->toArray();
        $this->assertArrayHasKey('id', $createdResponse);
        $this->assertNotNull($createdResponse['id'], 'Created Response must have id specified');
        $this->assertNotNull(Response::find($createdResponse['id']), 'Response with given id must be in DB');
        $this->assertModelData($response, $createdResponse);
    }

    /**
     * @test read
     */
    public function testReadResponse()
    {
        $response = $this->makeResponse();
        $dbResponse = $this->responseRepo->find($response->id);
        $dbResponse = $dbResponse->toArray();
        $this->assertModelData($response->toArray(), $dbResponse);
    }

    /**
     * @test update
     */
    public function testUpdateResponse()
    {
        $response = $this->makeResponse();
        $fakeResponse = $this->fakeResponseData();
        $updatedResponse = $this->responseRepo->update($fakeResponse, $response->id);
        $this->assertModelData($fakeResponse, $updatedResponse->toArray());
        $dbResponse = $this->responseRepo->find($response->id);
        $this->assertModelData($fakeResponse, $dbResponse->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteResponse()
    {
        $response = $this->makeResponse();
        $resp = $this->responseRepo->delete($response->id);
        $this->assertTrue($resp);
        $this->assertNull(Response::find($response->id), 'Response should not exist in DB');
    }
}
