<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NasaService
{

    const URL = 'https://api.nasa.gov/planetary/apod';

    private $client;

    private $parameterBag;

    public function __construct(HttpClientInterface $client, ParameterBagInterface $parameterBag)
    {
        $this->client = $client;
        $this->parameterBag = $parameterBag;
    }

    public function isImage($url)
    {
        $imgExts = array("gif", "jpg", "jpeg", "png", "tiff", "tif");
        $urlExt = pathinfo($url, PATHINFO_EXTENSION);
        if (in_array($urlExt, $imgExts)) {
          return true;
        }
    }


    public function getPicture() : array
    {

        $min = strtotime(2000 - 01 - 01);
        $max = strtotime(2019 - 19 - 01);
        $val = Rand($min, $max);
        $picture = $response = $this->client->request('GET', self::URL, [
            'query' => [
                'api_key' => $this->parameterBag->get('api_key'),
                'date' => date('Y-m-d', $val),
            ]
        ]);
            return $picture->toArray();
    }
}
