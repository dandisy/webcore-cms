<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExceptionApiTest extends TestCase
{
    use MakeExceptionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateException()
    {
        $exception = $this->fakeExceptionData();
        $this->json('POST', '/api/v1/exceptions', $exception);

        $this->assertApiResponse($exception);
    }

    /**
     * @test
     */
    public function testReadException()
    {
        $exception = $this->makeException();
        $this->json('GET', '/api/v1/exceptions/'.$exception->id);

        $this->assertApiResponse($exception->toArray());
    }

    /**
     * @test
     */
    public function testUpdateException()
    {
        $exception = $this->makeException();
        $editedException = $this->fakeExceptionData();

        $this->json('PUT', '/api/v1/exceptions/'.$exception->id, $editedException);

        $this->assertApiResponse($editedException);
    }

    /**
     * @test
     */
    public function testDeleteException()
    {
        $exception = $this->makeException();
        $this->json('DELETE', '/api/v1/exceptions/'.$exception->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/exceptions/'.$exception->id);

        $this->assertResponseStatus(404);
    }
}
