<?php

use Faker\Factory as Faker;
use App\Models\Admin\Type;
use App\Repositories\Admin\TypeRepository;

trait MakeTypeTrait
{
    /**
     * Create fake instance of Type and save it in database
     *
     * @param array $typeFields
     * @return Type
     */
    public function makeType($typeFields = [])
    {
        /** @var TypeRepository $typeRepo */
        $typeRepo = App::make(TypeRepository::class);
        $theme = $this->fakeTypeData($typeFields);
        return $typeRepo->create($theme);
    }

    /**
     * Get fake instance of Type
     *
     * @param array $typeFields
     * @return Type
     */
    public function fakeType($typeFields = [])
    {
        return new Type($this->fakeTypeData($typeFields));
    }

    /**
     * Get fake data of Type
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTypeData($typeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'keterangan' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $typeFields);
    }
}
