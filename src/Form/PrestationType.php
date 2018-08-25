<?php

namespace App\Form;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nom de la manifestation'))
            ->add('datePrestation', DateType::class, array('label'  => 'Date de la prestation',
                                                  'format'  => 'dd/MM/yyyy',
                                                  'widget' => 'single_text'))
            ->add('place', TextType::class, array('label' => 'Commune'))
            ->add('client', EntityType::class, array(
                'class' => Client::class,
                'query_builder' => function (ClientRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.organisation', 'ASC');
                },
                'choice_label' => 'organisation',
                'group_by' => function($choiceValue, $key, $value) {return 'Existants';},
            ))
            ->add('save', SubmitType::class, array('label' => 'Valider'));
    }

    public function getName()
    {
        return 'prestation';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Prestation',
        ));
    }
}