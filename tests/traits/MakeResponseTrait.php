<?php

use Faker\Factory as Faker;
use App\Models\Response;
use App\Repositories\ResponseRepository;

trait MakeResponseTrait
{
    /**
     * Create fake instance of Response and save it in database
     *
     * @param array $responseFields
     * @return Response
     */
    public function makeResponse($responseFields = [])
    {
        /** @var ResponseRepository $responseRepo */
        $responseRepo = App::make(ResponseRepository::class);
        $theme = $this->fakeResponseData($responseFields);
        return $responseRepo->create($theme);
    }

    /**
     * Get fake instance of Response
     *
     * @param array $responseFields
     * @return Response
     */
    public function fakeResponse($responseFields = [])
    {
        return new Response($this->fakeResponseData($responseFields));
    }

    /**
     * Get fake data of Response
     *
     * @param array $postFields
     * @return array
     */
    public function fakeResponseData($responseFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nomor' => $fake->word,
            'tanggal' => $fake->word,
            'nomor_keberatan' => $fake->word,
            'keterangan' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $responseFields);
    }
}
