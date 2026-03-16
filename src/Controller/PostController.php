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
        // Nos busca y renderiza/pinta todos los posts
        $posts = $this->em->getRepository(Post::class)->findAll();

        // Nos busca y renderiza uno o varios posts según el criterio/los parámetros que pongamos
        $post = $this->em->getRepository(Post::class)->findBy(['type' => 'guepardo']);

        // Nos busca y renderiza SOLO uno (no devolverá un array)
        $singlePost = $this->em->getRepository(Post::class)->findOneBy(['id' => 1]);

        return $this->render('post/index.html.twig', [ 
            'posts' => $posts,
            'post' => $post,
            'singlePost' => $singlePost,
        ]);
    }
}