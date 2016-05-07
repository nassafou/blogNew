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
    
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();// recupération de l'entity manager
        $articles = $em->getRepository('BlogNewBundle:Article')
                       ->getArticles(3, $page); // 3 articles par page : C'est totalement arbitre!
           
          
          //On ajoute ici les variables page et nb_page à la vue
           return $this->render('BlogNewBundle:Blog:index.html.twig',
                                array(
                                      'articles' => $articles,
                                      'page'     => $page,
                                      'nombrePage' => ceil(count($articles)/3)
                                      ));            
    }
    public function index22Action($page)
    {
       // on ne sait pas combien de page il y a
       // Mais on sait qu'une page doit être supérieur ou égale à 1
       if($page < 1)
       {
        // on déclenche une exception NotFoundHttpException
        // cela  va affichier la page d'erreur 404 (a personaliser plus tard)
        throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
       }
    
    // Ici, on recupper la liste des articles
    // Pour récupérer la liste de tous les articles : on utilise findAll()
        $em = $this->getDoctrine()
                         ->getManager();
                         
           $article = $em->getRepository('BlogNewBundle:Article')
                         ->getArticles();
      // L'appel de vue ne change pas 
        return $this->render('BlogNewBundle:Blog:index.html.twig', array('articles' => $articles ));
    }
    public function voirAction(Article $article)
    {
       // On récupère l'EntityManager
       $em = $this->getDoctrine()
                  ->getManager();
                  
        $listeArticleCompetence = $em->getRepository('BlogNewBundle:ArticleCompetence')
                                     ->findByArticle($article->getId());
                  
        // Pour récupérer un article unique : on utilise find()
        //$article = $em->getRepository('BlogNewBundle:Article')
                      //->find($id);
                      
        if($article === null){
            throw $this->createNotFoundException('Article[id='.$id.']inexistant.');
                      
        }
        
        // On recupere les articleCompetence pour l'article
        $liste_articleCompetence = $em->getRepository('BlogNewBundle:ArticleCompetence')
                                      ->findByArticle($article->getId());
                                      
                                      
      return $this->render('BlogNewBundle:Blog:voir.html.twig', array('article' => $article,
                                                                      'listeArticleCompetence' => $liste_articleCompetence
                                                                      // Pas besoin de passer les commentaires à la vue, on pourra
                                                                      // y acceder via {{ article.commentaire}}
                                                                      
                                                                      ));
        
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
        // Recupérer l'entity manager
        $em = $this->getDoctrine()
                   ->getManager();
        
         //Ici On recupere l'article  correspondant à $id              
        $article = $em->getRepository('BlogNewBundle:Article')
                                    ->find($id);
                      
        // Si l'article n'existe pas
        if( $article == null ){
            throw $this->createNotFoundException('Article[id='.$id.'] inexistant');
        }
        
       
        
        //Ici, on s'occupe de la gestion et de la création  du formulaire
        
        return $this->render('BlogNewBundle:Blog:modifier.html.twig', array('article' => $article,
                                                                            ));
    }
    
    public function supprimerAction($id)
    {
        // on recupere l'entity manager
        $em = $this->getDoctrine()
                   ->getManager();
                   
        //Ici On recupere l'article  correspondant à $id
        $article = $this->getRepository('BlogNewBundle:Article')
                        ->find($id);
                        
        // Si l'article n'existe pas, on affiche une erreur 404
        if ( $article == null ){
            throw $this->createNotFoundException('Article[id='.$id.']inexistant');
        }
        
        if($this->get('request')->getMethod() == 'POST'){
            // Si la requete est en POST, on supprimera l'article
            $this->get('session')->getFlashBag()->add('info', 'Article bien supprimé');
            // Puis on redirige vers l'accueil
            return $this->redirect($this->generateUrl('yatblogNew_accueil'));
        }
        
        // Si la requete est en GET, on affiche une page de confirmation avant de supprimer
        // Ici, On gere la suppression de l'article
        return $this->render('BlogNewBundle:Blog:supprimer.html.twig', array( 'article' => $article)); 
    }
    
    public function menuAction($nombre)
    {   
        // recupération des entity manager
        $em = $this->getDoctrine()
                   ->getManager();
                //recupération de aticle
                
        $liste = $em->getRepository('BlogNewBundle:Article')
                     ->findBy(
                        array(), // Pas critère
                        array('date' => 'desc'), // On trie par date décroissante
                        $nombre, // on sélectionne $nombre article
                        0        // A partir premier
                        
                        );
        
        //recuperation de l'entity
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
