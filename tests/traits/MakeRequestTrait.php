<?php

use Faker\Factory as Faker;
use App\Models\Request;
use App\Repositories\RequestRepository;

trait MakeRequestTrait
{
    /**
     * Create fake instance of Request and save it in database
     *
     * @param array $requestFields
     * @return Request
     */
    public function makeRequest($requestFields = [])
    {
        /** @var RequestRepository $requestRepo */
        $requestRepo = App::make(RequestRepository::class);
        $theme = $this->fakeRequestData($requestFields);
        return $requestRepo->create($theme);
    }

    /**
     * Get fake instance of Request
     *
     * @param array $requestFields
     * @return Request
     */
    public function fakeRequest($requestFields = [])
    {
        return new Request($this->fakeRequestData($requestFields));
    }

    /**
     * Get fake data of Request
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRequestData($requestFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nomor' => $fake->word,
            'tanggal' => $fake->word,
            'nama_pengguna' => $fake->word,
            'nomor_identitas_pengguna' => $fake->word,
            'telepon' => $fake->word,
            'email' => $fake->word,
            'keterangan' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $requestFields);
    }
}
