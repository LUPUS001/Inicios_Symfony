<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'quien_eres' => [
                'antonio' => 'Hola soy Antonio',
                'julio' => 'Hola soy Julio',
                'aaron' => 'Hola soy Aarón',
                'alexia' => 'Hola soy Alexia',
                'ioel' => 'Hola soy Ioel',
            ],
            'edad' => 10110,
            'numeros' => [[1,2,3,4,5],[1,2,3,4]],
            'comidas' => [
                'macarrones' => '12€',
                'pizza' => '11€', 
                'lasaña' => '10€',
                'hamburguesa' => '8€',
            ],
        ]);
    }
}
