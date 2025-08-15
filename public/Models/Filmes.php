<?php
namespace Models;

class Filmes
{
    public $title;
    public $episode_id;
    public $opening_crawl;
    public $release_date;
    public $director;
    public $producer;
    public $characters = []; // array de nomes
    public $age; // idade do filme: anos, meses, dias

    public function __construct($data)
    {
        $this->title = $data['title'] ?? '';
        $this->episode_id = $data['episode_id'] ?? '';
        $this->opening_crawl = $data['opening_crawl'] ?? '';
        $this->release_date = $data['release_date'] ?? '';
        $this->director = $data['director'] ?? '';
        $this->producer = $data['producer'] ?? '';
        $this->characters = $data['characters'] ?? [];

        $this->calculateAge();
    }

    private function calculateAge()
    {
        if (!$this->release_date) {
            $this->age = '';
            return;
        }

        $release = new \DateTime($this->release_date);
        $today = new \DateTime();
        $diff = $release->diff($today);

        $this->age = sprintf(
            '%d anos, %d meses e %d dias',
            $diff->y,
            $diff->m,
            $diff->d
        );
    }
}