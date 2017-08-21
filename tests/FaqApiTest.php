<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FaqApiTest extends TestCase
{
    use MakeFaqTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFaq()
    {
        $faq = $this->fakeFaqData();
        $this->json('POST', '/api/v1/faqs', $faq);

        $this->assertApiResponse($faq);
    }

    /**
     * @test
     */
    public function testReadFaq()
    {
        $faq = $this->makeFaq();
        $this->json('GET', '/api/v1/faqs/'.$faq->id);

        $this->assertApiResponse($faq->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFaq()
    {
        $faq = $this->makeFaq();
        $editedFaq = $this->fakeFaqData();

        $this->json('PUT', '/api/v1/faqs/'.$faq->id, $editedFaq);

        $this->assertApiResponse($editedFaq);
    }

    /**
     * @test
     */
    public function testDeleteFaq()
    {
        $faq = $this->makeFaq();
        $this->json('DELETE', '/api/v1/faqs/'.$faq->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/faqs/'.$faq->id);

        $this->assertResponseStatus(404);
    }
}
