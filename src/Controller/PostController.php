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
            'controller_name' => 'Buenas soy Tonio',
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
