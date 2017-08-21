<?php

use Faker\Factory as Faker;
use App\Models\Admin\Archive;
use App\Repositories\Admin\ArchiveRepository;

trait MakeArchiveTrait
{
    /**
     * Create fake instance of Archive and save it in database
     *
     * @param array $archiveFields
     * @return Archive
     */
    public function makeArchive($archiveFields = [])
    {
        /** @var ArchiveRepository $archiveRepo */
        $archiveRepo = App::make(ArchiveRepository::class);
        $theme = $this->fakeArchiveData($archiveFields);
        return $archiveRepo->create($theme);
    }

    /**
     * Get fake instance of Archive
     *
     * @param array $archiveFields
     * @return Archive
     */
    public function fakeArchive($archiveFields = [])
    {
        return new Archive($this->fakeArchiveData($archiveFields));
    }

    /**
     * Get fake data of Archive
     *
     * @param array $postFields
     * @return array
     */
    public function fakeArchiveData($archiveFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'judul' => $fake->word,
            'tanggal' => $fake->word,
            'jenis_informasi' => $fake->word,
            'asal' => $fake->word,
            'bentuk_informasi' => $fake->word,
            'keterangan' => $fake->text,
            'file' => $fake->word,
            'verified' => $fake->word,
            'verified_by' => $fake->word,
            'created_by' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $archiveFields);
    }
}
