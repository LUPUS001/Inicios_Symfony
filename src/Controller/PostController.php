<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    
    #[Route('/post/{id}', name: 'app_post')]
    public function index($id): Response
    {
        // Pueden parecer lo mismo a simple vista, pero...

        $post = $this->em->getRepository(Post::class)->find($id); //este traerá el post entero 

        $custom_post = $this->em->getRepository(Post::class)->findPost($id); //este traera el post con los filtros que le hemos configurado

        return $this->render('post/index.html.twig', [ 
            'post' => $post,
            'custom_post' => $custom_post,
        ]);
    }
}