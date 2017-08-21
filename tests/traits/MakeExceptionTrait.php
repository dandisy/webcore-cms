<?php

use Faker\Factory as Faker;
use App\Models\Exception;
use App\Repositories\ExceptionRepository;

trait MakeExceptionTrait
{
    /**
     * Create fake instance of Exception and save it in database
     *
     * @param array $exceptionFields
     * @return Exception
     */
    public function makeException($exceptionFields = [])
    {
        /** @var ExceptionRepository $exceptionRepo */
        $exceptionRepo = App::make(ExceptionRepository::class);
        $theme = $this->fakeExceptionData($exceptionFields);
        return $exceptionRepo->create($theme);
    }

    /**
     * Get fake instance of Exception
     *
     * @param array $exceptionFields
     * @return Exception
     */
    public function fakeException($exceptionFields = [])
    {
        return new Exception($this->fakeExceptionData($exceptionFields));
    }

    /**
     * Get fake data of Exception
     *
     * @param array $postFields
     * @return array
     */
    public function fakeExceptionData($exceptionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nomor' => $fake->word,
            'tanggal' => $fake->word,
            'nomor_permohonan' => $fake->word,
            'keterangan' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $exceptionFields);
    }
}
