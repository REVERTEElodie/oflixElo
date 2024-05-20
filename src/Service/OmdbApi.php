<?php
// Fichier : OmdbApi.php | Date: 2024-01-22 | Auteur: Patrick SUFFREN

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbApi
{
    public function __construct(
        private HttpClientInterface $client,
        private string $apikey
    ) {
    }
    public function fetchPoster(string $title)
    {
        // appeller l'api de omdb
        $response = $this->client->request(
            'GET',
            'http://www.omdbapi.com/', [
                // these values are automatically encoded before including them in the URL
                'query' => [
                    'apikey' => $this->apikey,
                    't' => $title,
                ],
            ]);

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        // Return Early Pattern
        // REFER : https://medium.com/swlh/return-early-pattern-3d18a41bba8
        if ($statusCode != 200) {
            return null;
        }
        // récupérer le JSON sous forme de tableau
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        // vérifier si l'entrée du poster existe
        if (!isset($content['Poster'])) {
            return null;
        }
        
        // récupérer l'entrée Poster du json
        return $content['Poster'];
    }
}