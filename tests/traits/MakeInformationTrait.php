<?php

use Faker\Factory as Faker;
use App\Models\Information;
use App\Repositories\InformationRepository;

trait MakeInformationTrait
{
    /**
     * Create fake instance of Information and save it in database
     *
     * @param array $informationFields
     * @return Information
     */
    public function makeInformation($informationFields = [])
    {
        /** @var InformationRepository $informationRepo */
        $informationRepo = App::make(InformationRepository::class);
        $theme = $this->fakeInformationData($informationFields);
        return $informationRepo->create($theme);
    }

    /**
     * Get fake instance of Information
     *
     * @param array $informationFields
     * @return Information
     */
    public function fakeInformation($informationFields = [])
    {
        return new Information($this->fakeInformationData($informationFields));
    }

    /**
     * Get fake data of Information
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInformationData($informationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'judul' => $fake->word,
            'tanggal' => $fake->word,
            'jenis_informasi' => $fake->word,
            'bentuk_informasi' => $fake->word,
            'keterangan' => $fake->text,
            'tag' => $fake->word,
            'file' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $informationFields);
    }
}
