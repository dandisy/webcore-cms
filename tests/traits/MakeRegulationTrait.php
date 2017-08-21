<?php

use Faker\Factory as Faker;
use App\Models\Regulation;
use App\Repositories\RegulationRepository;

trait MakeRegulationTrait
{
    /**
     * Create fake instance of Regulation and save it in database
     *
     * @param array $regulationFields
     * @return Regulation
     */
    public function makeRegulation($regulationFields = [])
    {
        /** @var RegulationRepository $regulationRepo */
        $regulationRepo = App::make(RegulationRepository::class);
        $theme = $this->fakeRegulationData($regulationFields);
        return $regulationRepo->create($theme);
    }

    /**
     * Get fake instance of Regulation
     *
     * @param array $regulationFields
     * @return Regulation
     */
    public function fakeRegulation($regulationFields = [])
    {
        return new Regulation($this->fakeRegulationData($regulationFields));
    }

    /**
     * Get fake data of Regulation
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRegulationData($regulationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'judul' => $fake->word,
            'status' => $fake->word,
            'keterangan' => $fake->text,
            'file' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $regulationFields);
    }
}
