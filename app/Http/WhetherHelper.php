<?php

namespace App\Http;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;

class WhetherHelper
{
    const YANDEX_API_KEY = '2da4a08f-f3f4-445d-9452-2c8abdd5a420';
    const API_URL = 'https://api.weather.yandex.ru/v2/forecast/';

    protected $lat;
    protected $lon;

    public function __construct($lat, $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getTemperature()
    {
        $client = new GuzzleClient(['headers' => [
            'X-Yandex-API-Key' => self::YANDEX_API_KEY,
        ]]);

        try {
            $response = $client->get(self::API_URL, array(
                'query'=> array(
                    'lat' => $this->lat,
                    'lon' => $this->lon,
                    'extra' => 'true',
                )
            ));
        } catch (GuzzleException $e) {
            echo 'Что-то пошло не так! Возможная ошибка:' . $e->getMessage();
            exit();
        }

        $tempObj = json_decode($response->getBody()->getContents());

        return $tempObj->fact->temp;
    }
}