<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Dogs
{
    private $imageUrl;

    public function __construct() {
        $this->getDog();
    }

    public function getImage() {
        return $this->imageUrl;
    }

    private function getDog() {
        $response = Http::get('https://dog.ceo/api/breeds/image/random')->json();
        $this->imageUrl = $response['message'];
    }
}