<?php

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryRepositoryTest extends TestCase
{
    use MakeCategoryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categoryRepo = App::make(CategoryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCategory()
    {
        $category = $this->fakeCategoryData();
        $createdCategory = $this->categoryRepo->create($category);
        $createdCategory = $createdCategory->toArray();
        $this->assertArrayHasKey('id', $createdCategory);
        $this->assertNotNull($createdCategory['id'], 'Created Category must have id specified');
        $this->assertNotNull(Category::find($createdCategory['id']), 'Category with given id must be in DB');
        $this->assertModelData($category, $createdCategory);
    }

    /**
     * @test read
     */
    public function testReadCategory()
    {
        $category = $this->makeCategory();
        $dbCategory = $this->categoryRepo->find($category->id);
        $dbCategory = $dbCategory->toArray();
        $this->assertModelData($category->toArray(), $dbCategory);
    }

    /**
     * @test update
     */
    public function testUpdateCategory()
    {
        $category = $this->makeCategory();
        $fakeCategory = $this->fakeCategoryData();
        $updatedCategory = $this->categoryRepo->update($fakeCategory, $category->id);
        $this->assertModelData($fakeCategory, $updatedCategory->toArray());
        $dbCategory = $this->categoryRepo->find($category->id);
        $this->assertModelData($fakeCategory, $dbCategory->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCategory()
    {
        $category = $this->makeCategory();
        $resp = $this->categoryRepo->delete($category->id);
        $this->assertTrue($resp);
        $this->assertNull(Category::find($category->id), 'Category should not exist in DB');
    }
}
