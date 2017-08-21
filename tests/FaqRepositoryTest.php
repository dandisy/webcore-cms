<?php

use App\Models\Faq;
use App\Repositories\FaqRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FaqRepositoryTest extends TestCase
{
    use MakeFaqTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FaqRepository
     */
    protected $faqRepo;

    public function setUp()
    {
        parent::setUp();
        $this->faqRepo = App::make(FaqRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFaq()
    {
        $faq = $this->fakeFaqData();
        $createdFaq = $this->faqRepo->create($faq);
        $createdFaq = $createdFaq->toArray();
        $this->assertArrayHasKey('id', $createdFaq);
        $this->assertNotNull($createdFaq['id'], 'Created Faq must have id specified');
        $this->assertNotNull(Faq::find($createdFaq['id']), 'Faq with given id must be in DB');
        $this->assertModelData($faq, $createdFaq);
    }

    /**
     * @test read
     */
    public function testReadFaq()
    {
        $faq = $this->makeFaq();
        $dbFaq = $this->faqRepo->find($faq->id);
        $dbFaq = $dbFaq->toArray();
        $this->assertModelData($faq->toArray(), $dbFaq);
    }

    /**
     * @test update
     */
    public function testUpdateFaq()
    {
        $faq = $this->makeFaq();
        $fakeFaq = $this->fakeFaqData();
        $updatedFaq = $this->faqRepo->update($fakeFaq, $faq->id);
        $this->assertModelData($fakeFaq, $updatedFaq->toArray());
        $dbFaq = $this->faqRepo->find($faq->id);
        $this->assertModelData($fakeFaq, $dbFaq->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFaq()
    {
        $faq = $this->makeFaq();
        $resp = $this->faqRepo->delete($faq->id);
        $this->assertTrue($resp);
        $this->assertNull(Faq::find($faq->id), 'Faq should not exist in DB');
    }
}
