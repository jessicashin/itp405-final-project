<?php

namespace App\Services\API;
use Cache;

class Flickr {
    protected $api_key;
    const ENDPOINT = 'https://api.flickr.com/services/rest/';

    public function __construct(array $config) {
        $this->api_key = $config['api_key'];
    }

    public function getPhotos() {
        if (Cache::get('dog_photos')) {
            $jsonString = Cache::get('dog_photos');
        } else {
            $url = $this->buildRequestURL('flickr.photos.search', [
                'text' => 'dog bw',
                'content_type' => 1,
                'sort' => 'relevance',
                'extras' => 'url_q',
                'format' => 'json',
                'nojsoncallback' => 1,
                'safe_search' => 1,
                'per_page' => 10,
            ]);
            $jsonString = file_get_contents($url);
            Cache::put('dog_photos', $jsonString, 10);
        }
        $photos = json_decode($jsonString)->photos;
        return $photos;
    }

    protected function buildRequestURL($method, $qs = []) {
        $qs['api_key'] = $this->api_key;
        return self::ENDPOINT . '?method=' . $method . '&' . http_build_query($qs);
    }
}