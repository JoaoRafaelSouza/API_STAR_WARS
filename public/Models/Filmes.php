<?php
class Filmes
{
    public $title;
    public $release_date;

    public function __construct($data)
    {
        $this->title = $data['title'] ?? '';
        $this->release_date = $data['release_date'] ?? '';
    }
}