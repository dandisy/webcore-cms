<?php

use Faker\Factory as Faker;
use App\Models\Admin\Origin;
use App\Repositories\Admin\OriginRepository;

trait MakeOriginTrait
{
    /**
     * Create fake instance of Origin and save it in database
     *
     * @param array $originFields
     * @return Origin
     */
    public function makeOrigin($originFields = [])
    {
        /** @var OriginRepository $originRepo */
        $originRepo = App::make(OriginRepository::class);
        $theme = $this->fakeOriginData($originFields);
        return $originRepo->create($theme);
    }

    /**
     * Get fake instance of Origin
     *
     * @param array $originFields
     * @return Origin
     */
    public function fakeOrigin($originFields = [])
    {
        return new Origin($this->fakeOriginData($originFields));
    }

    /**
     * Get fake data of Origin
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOriginData($originFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'sub' => $fake->word,
            'keterangan' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $originFields);
    }
}
