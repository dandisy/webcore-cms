<?php

use Faker\Factory as Faker;
use App\Models\Admin\Format;
use App\Repositories\Admin\FormatRepository;

trait MakeFormatTrait
{
    /**
     * Create fake instance of Format and save it in database
     *
     * @param array $formatFields
     * @return Format
     */
    public function makeFormat($formatFields = [])
    {
        /** @var FormatRepository $formatRepo */
        $formatRepo = App::make(FormatRepository::class);
        $theme = $this->fakeFormatData($formatFields);
        return $formatRepo->create($theme);
    }

    /**
     * Get fake instance of Format
     *
     * @param array $formatFields
     * @return Format
     */
    public function fakeFormat($formatFields = [])
    {
        return new Format($this->fakeFormatData($formatFields));
    }

    /**
     * Get fake data of Format
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFormatData($formatFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'keterangan' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $formatFields);
    }
}
