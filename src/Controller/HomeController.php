<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil
     *@Route("/", name="homepage")
     * @return Response
     */
    public function home()
    {

        $prenom = ["Lior" => 31, "Dom" => 36, "Lindsay" => 29];

        return $this->render(
            'home.html.twig',
            [
                'title' => "Bonjour à tous",
                'age' => 15,
                'tab' => $prenom
            ]
        );
    }
}
