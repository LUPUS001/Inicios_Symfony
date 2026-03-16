<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    // Recibir el id desde la URL
    #[Route('/post/{id}', name: 'app_post')]
    public function index(Post $post): Response
    {
        dump($post);
        
        return $this->render('post/index.html.twig', [
            // Pasamos el post al twig, lo renderizamos para que lo pinte por pantalla
            'post' => $post,

        ]);
    }
}
