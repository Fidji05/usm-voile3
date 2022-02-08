<?php

namespace App\Controller;

use App\Services\UserServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function index()
    {
        // Récupération des paramètres de l'url
        $request = Request::createFromGlobals();
        $userId = htmlspecialchars($request->query->get('id'));

        if (!is_numeric($userId)) {
            throw new \Exception("Le format de l'ID utilisateur doit etre numérique");
        }

        // Récupération des informations user
        $user = new UserServices($userId);

        return new Response(
            '<html><body>'
            . '<h1>USM Voile</h1>'
            . '<div>Bonjour ' . $user->getFirstName() . ' ' . $user->getLastName() . '</div>'
            . '<div>Environnement : ' . $_SERVER['APP_ENV'] . '</div>'
            . '</body></html>'
        );
    }
}
