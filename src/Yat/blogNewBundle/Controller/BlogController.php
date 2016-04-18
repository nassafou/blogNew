<?php

namespace Yat\blogNewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function indexAction($page)
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
       
       
        return $this->render('BlogNewBundle:Blog:index.html.twig');
    }
    public function voirAction($id)
    {
       // Ici, on recupere l'article correspondant à l'id $id 
      return $this->render('BlogNewBundle:Blog:voir.html.twig', array('id' => $id ));
        
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
        //Ici On recupere l'article  correspondant à $id
        
        //Ici, on s'occupe de la gestion et de la création  du formulaire
        
        return $this->render('BlogNewBundle:Blog:modifier.html.twig');
    }
    
    public function supprimerAction($id)
    {
        //Ici On recupere l'article  correspondant à $id
        // Ici, On gere la suppression de l'article
        return $this->render('BlogNewBundle:Blog:supprimer.html.twig'); 
    }
    
}
