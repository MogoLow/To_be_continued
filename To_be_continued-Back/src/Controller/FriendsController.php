<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;


class FriendsController extends AbstractController
{
    #[Route('/friends', name: 'friends', methods: 'POST')]
    public function friends(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);

        $id = $param['id'];
        $token = $param['token'];

        $client = HttpClient::create();
        $response = $client->request('GET', "https://api.betaseries.com/friends/list?key=6bbd6812fc3f&id=$id&token=$token");

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'friends' => false,
            ]);
        }
        $friends_list = $response->getContent();

        $response = $client->request('GET', "https://api.betaseries.com/friends/list?key=6bbd6812fc3f&blocked=true&token=$token");

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'friends' => false,
            ]);
        }
        $blocked_friends_list = $response->getContent();

        // $response = $client->request('GET', "https://api.betaseries.com/friends/requests?key=6bbd6812fc3f&id=$id&token=$token&blocked=");
        // $statusCode = $response->getStatusCode();
        // if ($statusCode != 200) {

        //     return $this->json([
        //         'friends' => false,
        //     ]);
        // }

        // $friends_requests = $response->getContent();


        return $this->json([
            'friends' => true,
            'friends_list' => $friends_list,
            // 'friends_requests' => $friends_requests,
            'blocked_friends_list' => $blocked_friends_list,
        ]);
    }

    #[Route('/blockORunblock_friend', name: 'blockORunblock_friend', methods: 'POST')]
    public function blockORunblock_friend(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);

        $id = $param['id'];
        $token = $param['token'];

        if ($param['method']) {
            $method = "POST";
        } else {
            $method = "DELETE";
        }

        $client = HttpClient::create();
        $response = $client->request($method, "https://api.betaseries.com/friends/block?key=6bbd6812fc3f&id=$id&token=$token");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'friends' => false,
            ]);
        } else

            return $this->json([
                'block_friend' => true,
            ]);
    }

    #[Route('/addORremove_friend', name: 'addORremove_friend', methods: 'POST')]
    public function addORremove_friend(Request $request): Response
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
        $response = $client->request($method, "https://api.betaseries.com/friends/friend?key=6bbd6812fc3f&id=$id&token=$token");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'friend' => false,
            ]);
        } else

            return $this->json([
                'friend' => true,
            ]);
    }

    #[Route('/find_friend', name: 'find_friend', methods: 'POST')]
    public function find_friend(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);

        $login = $param['login'];

        $client = HttpClient::create();
        $response = $client->request("GET", "https://api.betaseries.com/members/search?key=6bbd6812fc3f&login=$login");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'membre' => false,
            ]);
        }

        $content = $response->getContent();

        return $this->json([
            'membre' => true,
            'content' => $content
        ]);
    }

    #[Route('/info_friend', name: 'info_friend', methods: 'POST')]
    public function info_friend(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);

        $id = $param['id'];

        if (isset($param['token'])) {

            $token = $param['token'];
        } else {
            $token = "";
        }


        $client = HttpClient::create();
        $response = $client->request("GET", "https://api.betaseries.com/members/infos?key=6bbd6812fc3f&id=$id");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'info' => false,
            ]);
        }

        $content = $response->getContent();

        $response = $client->request(
            'GET',
            "https://api.betaseries.com/shows/member?key=6bbd6812fc3f&id=$id&token=$token"
        );
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json([
                'info' => false,
            ]);
        }

        $series_followed = $response->getContent();


        return $this->json([
            'info' => true,
            'content' => $content,
            'series_followed' => $series_followed,

        ]);
    }
}
