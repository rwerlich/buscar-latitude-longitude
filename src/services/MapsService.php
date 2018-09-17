<?php

namespace App\services;


class MapsService
{

    private $key;

    public function __construct(String $key)
    {
        $this->key = $key;
    }

    private function getCoordinates(String $url)
    {
        $cURL = curl_init($url);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($cURL);
        curl_close($cURL);
        if (!$result) {
            throw new \Exception('Erro ao buscar coordenadas');
        }
        return $result;
    }

    public function getLatLng(String $address)
    {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?key={$this->key}&address=" . urlencode($address);
        $data = json_decode($this->getCoordinates($url));
        if ($data->status !== 'OK') {
            throw new \Exception('Erro ao buscar coordenadas');
        }
        return $data->results[0]->geometry->location;
    }
}