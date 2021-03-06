<?php

namespace Yat\blogNewBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    public function getArticles($nombreParPage, $page)
    {
        // On déplace la vérification du numéro de page dans cette méthode
        if($page < 1){
            throw new \InvalidArgumentException('L\'argument $page ne peut être inferieur à 1 (valeur : "'.$page.'").');
        }
        
        // la construction de la requête reste inchangée
        $query = $this->createQueryBuilder('a')
                      ->leftJoin('a.image', 'i')//On joint sur l'attribut image
                      ->addSelect('i')
                      ->leftJoin('a.categories', 'c') //On joint l'attribut categorie
                      ->addSelect('c')
                      ->orderBy('a.date', 'DESC')
                      ->getQuery();
                      
        
        //$query->setFirstResult(($page-1) *  $nombreParPage) // On definit l'article à partir du quel commencer la liste
              //->setMaxResult($nombreParPage); // Ainsi que le nombre  d'articles à afficher
              
              
          //return new Paginator($query);            
        return $query->getResult();
    }
}
