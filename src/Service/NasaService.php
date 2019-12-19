<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NasaService
{
    private $client;
    
    private $parameterBag;
    
    public function __construct(HttpClientInterface $client, ParameterBagInterface $parameterBag)
    {
        $this->client = $client;
        $this->parameterBag = $parameterBag;
    }
    
    public function getPicture() : array
    {
        $url      = 'https://api.nasa.gov/planetary/apod';
        $response = $this->client->request('GET', $url, [
            'query' => [
                'api_key' => $this->parameterBag->get('api_key'),
                'date'    => '2019-01-01',
            ]
            
        ]);
        
        return $response->toArray();
        
    }
}