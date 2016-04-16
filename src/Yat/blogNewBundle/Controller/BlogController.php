<?php

namespace Yat\blogNewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function indexAction()
    {
       
       $id_article = 5;
       
       //$url = $this->generateUrl('yatblog_voir', array('id' => $id));
       
       //return $this->redirect($url);
       
       // return new Response("Hello World !");
        //return $this->render('BlogNewBundle:Default:index.html.twig', array('name' => $name));
        return $this->render('BlogNewBundle:Blog:index.html.twig', array('id_article' => $id_article));
    }
    public function voirAction($id)
    {
       return new Response("Voir l'article ".$id."." );
        //return $this->render('BlogNewBundle:Default:index.html.twig', array('name' => $name));
        //return $this->render('BlogNewBundle:Blog:index.html.twig', array('name' => 'youf'));
    }
    
    public function voirSlugAction($slug,$annee,$format)
    {
       return new Response("Voir l'article correspondant au slug , ".$slug." l' annnée ".$annee." au format.".$format."." );
        //return $this->render('BlogNewBundle:Default:index.html.twig', array('name' => $name));
        //return $this->render('BlogNewBundle:Blog:index.html.twig', array('name' => 'youf'));
    }
    
     public function ajouterAction()
    {
       
        return $this->render('BlogNewBundle:Blog:index.html.twig', array('name' => 'youf'));
    }
    
}
