<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;

class SeriesController extends AbstractController
{
    #[Route('/series', name: 'series')]
    public function index(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);
        $token = $param['token'];


        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://api.betaseries.com/shows/list?key=c81ab9f947a0&fields=id,title,
            description,images.poster,seasons,episodes,creation,genres,in_account,length,language,
            seasons_details,user&order=popularity&token=$token"
        );
        $content = $response->getContent();
        $content = json_decode($content);
        return $this->json([
            'content' => $content,
        ]);
    }
    #[Route('/oneSerie', name: 'oneSerie', methods: ['POST'])]


    public function oneSerie(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);


        $id = $param['id'];
        $bool = false;
        if (isset($param['token'])) {
            $token = $param['token'];
        } else {
            $token = "";
        }

        if (!is_int(json_decode($id))) {
            return $this->json(['serie' => false,]);
        }
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://api.betaseries.com/shows/display?key=c81ab9f947a0&id=$id&token=$token"
        );

        $content = $response->getContent();
        $content = json_decode($content);

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'serie' => false,
            ]);
        }

        if ($param['id_user'] != false) {
            $id_user = $param['id_user'];

            $response = $client->request(
                'GET',
                "https://api.betaseries.com/shows/member?key=6bbd6812fc3f&id=$id_user"
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode != 200) {

                return $this->json([
                    'serie' => false,
                ]);
            }

            $content2 = json_decode($response->getContent());

            foreach ($content2->shows as $key => $value) {

                if ($value->id == $id) {
                    $bool = true;
                    break;
                }
            }
        }


        $response = $client->request(
            'GET',
            "https://api.betaseries.com/shows/seasons?key=6bbd6812fc3f&id=$id"
        );
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'serie' => false,
            ]);
        }
        $saisons = json_decode($response->getContent());

        $response = $client->request(
            'GET',
            "https://api.betaseries.com/shows/episodes?key=6bbd6812fc3f&id=$id&token=$token"
        );
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'serie' => false,
            ]);
        }
        $episodes = json_decode($response->getContent());

        return $this->json([
            'serie' => $content,
            'follow' => $bool,
            'saison' => $saisons,
            "episodes" => $episodes->episodes
        ]);
    }

    #[Route('/follow', name: 'follow', methods: 'POST')]
    public function follow(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);

        $id = $param['id'];
        $token = $param['token'];

        if ($param['method'] == true) {
            $method = "POST";
        } elseif ($param['method'] == false) {
            $method = "DELETE";
        }
        $client = HttpClient::create();
        $response = $client->request($method, "https://api.betaseries.com/shows/show?key=6bbd6812fc3f&id=$id&token=$token");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'follow' => false,
            ]);
        } else

            return $this->json([
                'follow' => true,
            ]);
    }
    #[Route('/watched', name: 'watched', methods: 'POST')]
    public function watched(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);

        $id = $param['id'];
        $token = $param['token'];

        if ($param['method'] == true) {
            $method = "POST";
        } elseif ($param['method'] == false) {
            $method = "DELETE";
        }
        $client = HttpClient::create();
        $response = $client->request($method, "https://api.betaseries.com/episodes/watched?key=6bbd6812fc3f&id=$id&token=$token");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'watched' => false,
            ]);
        } else

            return $this->json([
                'watched' => true,
            ]);
    }

    #[Route('/episode', name: 'episode', methods: 'POST')]
    public function episode(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);

        $id = $param['id'];
        $token = $param['token'];

        $client = HttpClient::create();
        $response = $client->request("GET", "https://api.betaseries.com/episodes/display?key=6bbd6812fc3f&id=$id&token=$token");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'episode' => false,
            ]);
        } else

            $content = json_decode($response->getContent());

        return $this->json([
            'episode' => true, "content" => $content->episode
        ]);
    }
}
