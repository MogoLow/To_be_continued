<?php

namespace App\Controller;

use Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;


class AuthController extends AbstractController
{
    #[Route('/auth/login', name: 'auth', methods: 'POST')]
    public function auth(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);

        $client = HttpClient::create();
        $response = $client->request('POST', 'https://api.betaseries.com/members/auth?key=6bbd6812fc3f', [
            'body' => [
                'login' => $param['login'],
                'password' => md5($param['password']),
            ],
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {

            return $this->json(["error" => "mails ou mdp incorect"]);
        }
        $content = $response->getContent();
        return $this->json([
            'user' => $content,
        ]);
    }
}
