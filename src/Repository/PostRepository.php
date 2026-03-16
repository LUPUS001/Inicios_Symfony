<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findPost($id){
        return $this->getEntityManager()
            ->createQuery('
                SELECT post.id, post.title, post.type
                FROM App\Entity\Post post    
                WHERE post.id = :id
            ')
            ->setParameter('id', $id) /* Ponemos :id y luego le asignamos este valor a una variable, para no hacerlo de forma directa, ya que de hacerlo de esta forma, nos podrian hacer inyecciones SQL */
            ->getResult(); 
    }

    /* ¿Cómo funciona el mapeo? ':'

            Es como una etiqueta. Lo que pongas después de los dos puntos en la consulta debe coincidir con el primer nombre que pongas en setParameter 
    */



    //    /**
    //     * @return Post[] Returns an array of Post objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Post
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
