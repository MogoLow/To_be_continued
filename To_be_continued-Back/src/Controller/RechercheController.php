<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'recherche', methods: 'POST')]
    public function recherche(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);

        $recherche = $param['recherche'];

        $client = HttpClient::create();
        $response = $client->request("GET", "https://api.betaseries.com/shows/search?key=c81ab9f947a0&title=$recherche");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'recherche' => false,
            ]);
        }

        $content = $response->getContent();

        return $this->json([
            'recherche' => true,
            'content' => $content
        ]);
    }
}
