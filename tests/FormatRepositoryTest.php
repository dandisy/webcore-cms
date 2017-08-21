<?php

use App\Models\Format;
use App\Repositories\FormatRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FormatRepositoryTest extends TestCase
{
    use MakeFormatTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FormatRepository
     */
    protected $formatRepo;

    public function setUp()
    {
        parent::setUp();
        $this->formatRepo = App::make(FormatRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFormat()
    {
        $format = $this->fakeFormatData();
        $createdFormat = $this->formatRepo->create($format);
        $createdFormat = $createdFormat->toArray();
        $this->assertArrayHasKey('id', $createdFormat);
        $this->assertNotNull($createdFormat['id'], 'Created Format must have id specified');
        $this->assertNotNull(Format::find($createdFormat['id']), 'Format with given id must be in DB');
        $this->assertModelData($format, $createdFormat);
    }

    /**
     * @test read
     */
    public function testReadFormat()
    {
        $format = $this->makeFormat();
        $dbFormat = $this->formatRepo->find($format->id);
        $dbFormat = $dbFormat->toArray();
        $this->assertModelData($format->toArray(), $dbFormat);
    }

    /**
     * @test update
     */
    public function testUpdateFormat()
    {
        $format = $this->makeFormat();
        $fakeFormat = $this->fakeFormatData();
        $updatedFormat = $this->formatRepo->update($fakeFormat, $format->id);
        $this->assertModelData($fakeFormat, $updatedFormat->toArray());
        $dbFormat = $this->formatRepo->find($format->id);
        $this->assertModelData($fakeFormat, $dbFormat->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFormat()
    {
        $format = $this->makeFormat();
        $resp = $this->formatRepo->delete($format->id);
        $this->assertTrue($resp);
        $this->assertNull(Format::find($format->id), 'Format should not exist in DB');
    }
}
