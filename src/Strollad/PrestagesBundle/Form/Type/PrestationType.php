<?php

namespace Strollad\PrestagesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom de la prestation'))
            ->add('priceKendalch', 'text', array('label' => 'Prix Kendal\'ch'))
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