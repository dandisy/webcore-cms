<?php

use Faker\Factory as Faker;
use App\Models\Faq;
use App\Repositories\FaqRepository;

trait MakeFaqTrait
{
    /**
     * Create fake instance of Faq and save it in database
     *
     * @param array $faqFields
     * @return Faq
     */
    public function makeFaq($faqFields = [])
    {
        /** @var FaqRepository $faqRepo */
        $faqRepo = App::make(FaqRepository::class);
        $theme = $this->fakeFaqData($faqFields);
        return $faqRepo->create($theme);
    }

    /**
     * Get fake instance of Faq
     *
     * @param array $faqFields
     * @return Faq
     */
    public function fakeFaq($faqFields = [])
    {
        return new Faq($this->fakeFaqData($faqFields));
    }

    /**
     * Get fake data of Faq
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFaqData($faqFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'judul' => $fake->word,
            'tanggal' => $fake->word,
            'telepon' => $fake->word,
            'email' => $fake->word,
            'keterangan' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $faqFields);
    }
}
