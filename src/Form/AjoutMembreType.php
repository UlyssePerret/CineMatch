<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutMembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, [
                'label' => "Pseudo"
            ]) // "Symfony\Component\Form\Extension\Core\Type\TextType"
            ->add('password', TextType::class, [
                'label' => "Mot de Passe"
            ])
            ->add('email', TextType::class, [
                'label' => "Email"
            ])
            ->add('statut',ChoiceType::class,  [
            'label' => "Statut",
            'choices'  => [
                'Admin' => 0,
                'User' => 1,
                'Public' => 2,
            ],
            'required' =>false
            ])

            ->add('nom', TextType::class, [
                'label' => "Nom",
                'required' =>false
            ])
            ->add('prenom', TextType::class, [
                'label' => "Prenom",
                'required' =>false
            ])
            ->add('date_naissance', DateTimeType::class, [
                'label' => 'Date de début de naissance',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'required' =>false
            ])
            ->add('description', TextType::class, [
                'label' => "Description",
                'required' =>false
            ])
            ->add('photo', FileType::class, [
                'label' => "Photo",
                'required' =>false
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Ajouter Membre"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
