<?php

namespace Yat\blogNewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Yat\blogNewBundle\Antispam\YatAntispam;

class BlogController extends Controller
{
    public function index33Action()
    {
        //Déclaration de la variable
        $text = 'ggg@gmail.com, aaa@gmail.com, pppp@yahoo.fr';
        // on récupere le service
        $antispam = $this->container->get('yat_blognew.antispam');
        
        // on part sur le principe que $text contient le texte d'un message quelconque
        if($antispam->isSpam($text)){
            throw new \Exception('Votre message a été détecté comme spam');
        }
        // Le message n'est pas un spam
    }
    
    
    public function index1Action($page)
    {
        $liste_articles = array(
                          array( 'id' => 1,
                                 'titre' => 'harmanthant',
                                 'auteur' => 'Yoz',
                                 'date' => new \DateTime(),
                                 'type' => 'drame'),
                          array( 'id' => 2,
                                 'titre' => 'passe',
                                 'auteur' => 'Yat',
                                 'date' => new \DateTime(),
                                 'type' => 'politique'),
                          array( 'id' => 3,
                                 'titre' => 'un jour',
                                 'auteur' => 'Yazik',
                                 'date' => new \DateTime(),
                                 'type' => 'aventure')
                         );
      
       // on ne sait pas combien de page il y a
       // Mais on sait qu'une page doit être supérieur ou égale à 1
       if($page < 1)
       {
        // on déclenche une exception NotFoundHttpException
        // cela  va affichier la page d'erreur 404 (a personaliser plus tard)
        throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
       }
    
    // Ici, on recupper la liste des articles 
       
       
        return $this->render('BlogNewBundle:Blog:index.html.twig', array('articles' => $liste_articles ));
    }
    public function voirAction($id)
    {
       // Ici, on recupere l'article correspondant à l'id $id
       $liste_articles = array( 'id' => 1,
                                 'titre' => 'harmanthant',
                                 'auteur' => 'Yoz',
                                 'date' => new \DateTime(),
                                 'type' => 'drame');
                          array( 'id' => 2,
                                 'titre' => 'passe',
                                 'auteur' => 'Yat',
                                 'date' => new \DateTime(),
                                 'type' => 'politique');
                          array( 'id' => 3,
                                 'titre' => 'un jour',
                                 'auteur' => 'Yazik',
                                 'date' => new \DateTime(),
                                 'type' => 'aventure');
                        
      return $this->render('BlogNewBundle:Blog:voir.html.twig', array('id' => $id,
                                                                      'article' => $liste_articles));
        
    }
    
    public function voirSlugAction($slug,$annee,$format)
    {
       return new Response("Voir l'article correspondant au slug , ".$slug." l' annnée ".$annee." au format.".$format."." );
        
    }
    
    // ajouter cette methode a ajouterAction
     public function ajouterAction()
    {
        // La gestion de formulaire
        if($this->get('request')->getMethod() == 'POST')
        {
            // Ici, on s'occupera de la création et de la gestion du formulaire
            $this->get('session')->getFlashBag()->add('notice', 'Article bien enregistré');
            // Puis on redirige vers la page de visualisation
            return $this->redirect($this->generateUrl('yatblog_voir', array('id' => 5)));
        }
        
        
        // Si on n'est pas en POST , alors on affiche le formulaire
        return $this->render('BlogNewBundle:Blog:ajouter.html.twig');    
    }
    public function modifierAction($id)
    {
        $liste_articles = array(
                                'id' => 7,
                                'titre' => 'keria',
                                'date' => new \DateTime(),
                                'auteur' => 'wizou');
        
        //Ici On recupere l'article  correspondant à $id
        
        //Ici, on s'occupe de la gestion et de la création  du formulaire
        
        return $this->render('BlogNewBundle:Blog:modifier.html.twig', array('article' => $liste_articles,
                                                                            ));
    }
    
    public function supprimerAction($id)
    {
        //Ici On recupere l'article  correspondant à $id
        // Ici, On gere la suppression de l'article
        return $this->render('BlogNewBundle:Blog:supprimer.html.twig'); 
    }
    
    public function menuAction()
    {
        // on fixe en dur une liste ici,
        $liste = array(
          array('id' => 2, 'titre' => 'Mon dernier week-end'),
          array('id' => 5, 'titre' => 'Sortie de Symfony2'),
          array('id' => 9, 'titre' => 'Petit test')
        );
        return $this->render('BlogNewBundle:Blog:menu.html.twig', array('liste_articles' => $liste
                                                                        //c'est ici tout l'interêt : le controleur passe les variables au template
                                                                        ));
    }
    
    public function testAction()
    {
        $article = new Article;
        $article->setDate(new \DateTime()); // date d'aujourd'hui
        $article->setTitre('Mon dernier Weekend');
        $article->setAuteur('Bibi');
        $article->setContenu("c'était vraiment super et on s'est bien amusé");
        
        return $this->render('BlogNewBundle:Blog:test.html.twig', array('article' => $article));
    }
    
}
