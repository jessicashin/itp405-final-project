<?php

namespace App\Services\API;
use Cache;

class Flickr {
    protected $api_key;
    const ENDPOINT = 'https://api.flickr.com/services/rest/';

    public function __construct(array $config)
    {
        $this->api_key = $config['api_key'];
    }

    public function userPhotos($userID)
    {
        $url = $this->buildRequestURL('flickr.people.getPublicPhotos', [
            'user_id' => $userID,
            'per_page' => 5
        ]);
        if (Cache::get($url)) {
            $photosString = Cache::get($url);
            $xml = simplexml_load_string($photosString);
            $photos = $xml->{"photo"};
        } else {
            $xml = simplexml_load_file($url)->{"photos"};
            $photos = $xml->{"photo"};
            $photosString = $xml->asXML();
            Cache::put($url, $photosString, 5);
        }

        return $photos;
    }

    public function userID($username)
    {
        $url = $this->buildRequestURL('flickr.people.findByUsername', [
            'username' => $username
        ]);
        $xml = simplexml_load_file($url);
        $user = $xml->{"user"};
        $id = (string)$user["nsid"];

        return $id;
    }

    protected function buildRequestURL($method, $qs = [])
    {
        $qs['api_key'] = $this->api_key;
        return self::ENDPOINT . '?method=' . $method . '&' . http_build_query($qs);
    }
}