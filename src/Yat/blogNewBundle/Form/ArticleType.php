<?php

namespace Yat\blogNewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvents;
use Symfony\Compenent\Form\FormEvent;


class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder
        ->add('date', 'date')
        ->add('titre', 'text')
        ->add('contenu', 'textarea')
        ->add('auteur', 'text')
        ->add('publication', 'checkbox', array('required' => false ))
        ->add('image', new ImageType()) //
        /*
         *Rappel :
         ** - 1er argument : nom du champ, ici << categories >>, car c'est le nom de l'attribut
         ** - 2e argument : type du champ, ici << collection >> qui est une liste de quelque chose
         ** - 3e argument : tableau d'options du champ
         */
        ->add('categories', 'entity', array(
                                                'class' => 'BlogNewBundle:Categorie',
                                                'property' => 'nom',
                                                'multiple' => true ))
        ;
    
    }
    
     /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Yat\blogNewBundle\Entity\Article'
        ));
    }
    
    
     /**
     * @return string
     */
    public function getName()
    {
        return 'yat_blognewbundle_article';
    }
    
}