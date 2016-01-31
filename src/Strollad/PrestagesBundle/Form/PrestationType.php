<?php

namespace Strollad\PrestagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom de la manifestation'))
            ->add('datePrestation', 'date', array('label'  => 'Date de la prestation',
                                                  'format'  => 'dd/MM/yyyy',
                                                  'widget' => 'single_text'))
            ->add('place', 'text', array('label' => 'Commune'))
            ->add('client', EntityType::class, array(
                'class' => 'Strollad\PrestagesBundle\Entity\Client',
                'choice_label' => 'organisation'))
            ->add('save', 'submit', array('label' => 'Valider'));
    }

    public function getName()
    {
        return 'prestation';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Strollad\PrestagesBundle\Entity\Prestation',
        ));
    }
}