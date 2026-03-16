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

    // Insertar/crear nuevo post sin usar el construct de Post (usando este método/función no tendríamos que editar el constructor)
    #[Route('/insert1/post', name: 'insert_post')]
    public function insert(){
        $post = new Post();

        // El usuario que creará el post
        $user = $this->em->getRepository(User::class)->find(4); 

        $post->setTitle('Nuevo dia, nuevo yo')
            ->setType('hopecore')
            ->setDescription('todo comienzo, puede dar un nuevo resultado')
            ->setFile('pensamientos.pdf') // solamente pasamos texto, por ahora no subimos ningún archivo real
            ->setCreationDate(new DateTime())
            ->setUrl('twilight')
            ->setUser($user); // Aqui pasamos la variable $user que filtra el usuario exacto que queremos como creador/a del post

        $this->em->persist($post);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    // Insertar/crear nuevo post usando el constructor de Post
    #[Route('/insert2/post', name: 'insert_post')]
    public function insert2(){
        $post = new Post('Nuevo dia, nuevo yo', 'hopecore', 'todo comienzo, puede dar un nuevo resultado', 'pensamientos.pdf', 'twilight');

        $user = $this->em->getRepository(User::class)->find(4); 
        $post->setUser($user);

        $this->em->persist($post);
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    // Actualizamos un post existente 
    #[Route('/update/post', name: 'update_post')]
    public function update(){
        $post = $this->em->getRepository(Post::class)->find(4); // buscamos el post que vamos a actualizar/modificar
        $post->setTitle('Otro dia, otra oportunidad'); // simplemente cambiamos el titulo

        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    // Eliminamos un post existente
    #[Route('/remove/post', name: 'update_post')]
    public function remove(){
        $post = $this->em->getRepository(Post::class)->find(4); // buscamos el post que vamos a eliminar
        $this->em->remove($post);

        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }
}