<?php
namespace Yat\blogNewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

 /**
  *@ORM\Entity
  */

class ArticleCompetence
{
    /**
     *@ORM\Id
     *@ORM\ManyToOne(targetEntity="Yat\BlogNewBundle\Entity\Article")
     */
    private $article;
    
    /**
     *@ORM\Id
     *@ORM\ManyToOne(targetEntity="Yat\BlogNewBundle\Entity\Article")
     */
    private $competence;
    
    /**
     *@ORM\Column()
     */
    private $niveau;  // Ici j'ai un attribut de relation, que j'ai appelé <<niveau>>
    
    
}
