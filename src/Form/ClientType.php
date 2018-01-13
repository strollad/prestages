<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isMorale', 'checkbox', array('label' => 'Personne morale'))
            ->add('organisation')
            ->add('nom')
            ->add('prenom')
            ->add('adresse1')
            ->add('adresse2')
            ->add('codePostal')
            ->add('ville')
            ->add('telFixe')
            ->add('telPortable')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Strollad\PrestagesBundle\Entity\Client'
        ));
    }
}
