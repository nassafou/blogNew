<?php

namespace Yat\blogNewBundle\Form;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Yat\blogNewBundle\Antispam\YatAntispam;
use Yat\blogNewBundle\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder
        ->add('date', 'date')
        ->add('titre', 'text')
        ->add('contenu', 'textarea')
        ->add('auteur', 'text')
        ->add('publication', 'checkbox', array('required' => false ));
    
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefault(array(
            'data_class' => 'Yat\blogNewBundle\Entity\Article'));
    }
    
    public function getName()
    {
        return 'yat_blognewbundle_articletype';
    }
    
}