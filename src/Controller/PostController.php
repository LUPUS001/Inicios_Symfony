<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    
    #[Route('/post/insertar', name: 'insertar_post')]
    public function insertar(){
        $post = new Post('Que mierda de dia', 'depresion', 'hoy me he despertado y un dia de mierda, pero al final me he dado cuenta que', 'diario.doc', 'pensamientos-2');
        $user = $this->em->getRepository(User::class)->find(1);

        $post->setUserId($user);
        
        $this->em->persist($post);
        $this->em->flush();

        return new JsonResponse(['éxito webon' => true]);
    }

    #[Route('/post/update', name: 'update_post')]
    public function update(){
        $post = $this->em->getRepository(Post::class)->find(4);
        $post->setTitle('titulo cambiado');

        $this->em->flush();
        return new JsonResponse(['actualización exitosa' => true]);
    }

    #[Route('/post/delete/{id}', name: 'delete_post')]
    public function delete($id){
        $post = $this->em->getRepository(Post::class)->find($id);

        if (!$post) {
            return new JsonResponse(['error' => 'No se encontró el post con ID ' . $id], Response::HTTP_NOT_FOUND);
        }

        $this->em->remove($post);
        $this->em->flush();
        
        return new JsonResponse(['borrado exitoso' => true]);
    }

    #[Route('/posts', name: 'app_posts')]
    public function posts(): Response
    {
        $posts = $this->em->getRepository(Post::class)->findAll();   
        return $this->render('post/index2.html.twig', [ 
            'posts' => $posts,
        ]);
    }

    #[Route('/post/{id}', name: 'app_post')]
    public function index($id): Response
    {
        $post = $this->em->getRepository(Post::class)->find($id);
        $custom_post = $this->em->getRepository(Post::class)->encuentraPost($id);    
        
        return $this->render('post/index.html.twig', [ 
            'post' => $post,
            'custom_post' => $custom_post,
        ]);
    }
}