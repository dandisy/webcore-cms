<?php

use App\Models\Exception;
use App\Repositories\ExceptionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExceptionRepositoryTest extends TestCase
{
    use MakeExceptionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExceptionRepository
     */
    protected $exceptionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->exceptionRepo = App::make(ExceptionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateException()
    {
        $exception = $this->fakeExceptionData();
        $createdException = $this->exceptionRepo->create($exception);
        $createdException = $createdException->toArray();
        $this->assertArrayHasKey('id', $createdException);
        $this->assertNotNull($createdException['id'], 'Created Exception must have id specified');
        $this->assertNotNull(Exception::find($createdException['id']), 'Exception with given id must be in DB');
        $this->assertModelData($exception, $createdException);
    }

    /**
     * @test read
     */
    public function testReadException()
    {
        $exception = $this->makeException();
        $dbException = $this->exceptionRepo->find($exception->id);
        $dbException = $dbException->toArray();
        $this->assertModelData($exception->toArray(), $dbException);
    }

    /**
     * @test update
     */
    public function testUpdateException()
    {
        $exception = $this->makeException();
        $fakeException = $this->fakeExceptionData();
        $updatedException = $this->exceptionRepo->update($fakeException, $exception->id);
        $this->assertModelData($fakeException, $updatedException->toArray());
        $dbException = $this->exceptionRepo->find($exception->id);
        $this->assertModelData($fakeException, $dbException->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteException()
    {
        $exception = $this->makeException();
        $resp = $this->exceptionRepo->delete($exception->id);
        $this->assertTrue($resp);
        $this->assertNull(Exception::find($exception->id), 'Exception should not exist in DB');
    }
}
