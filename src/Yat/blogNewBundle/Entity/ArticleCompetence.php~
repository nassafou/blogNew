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
    
    

    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return ArticleCompetence
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set article
     *
     * @param \Yat\BlogNewBundle\Entity\Article $article
     *
     * @return ArticleCompetence
     */
    public function setArticle(\Yat\BlogNewBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Yat\BlogNewBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set competence
     *
     * @param \Yat\BlogNewBundle\Entity\Article $competence
     *
     * @return ArticleCompetence
     */
    public function setCompetence(\Yat\BlogNewBundle\Entity\Article $competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get competence
     *
     * @return \Yat\BlogNewBundle\Entity\Article
     */
    public function getCompetence()
    {
        return $this->competence;
    }
}
