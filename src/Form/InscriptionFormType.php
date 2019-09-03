<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Security;


class InscriptionFormType extends AbstractType
{
    /**
     * 
     */
    private $security;
    public function __construct(Security $security)
    {
         $this->security = $security;
    }



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, [
                'label' => "Pseudo"
            ]) // "Symfony\Component\Form\Extension\Core\Type\TextType"
            ->add( 'password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe'
                ],
                'second_options' => [
                    'label' => 'Confirmation mot de passe'
                ]
            ])
            ->add( 'email', EmailType::class, [
                'label' => 'Adresse email'
            ])
            ->add( 'nom', TextType::class, [
                'label' => 'Nom'
            ])
            ->add( 'prenom', TextType::class, [
                'label' => 'Prenom'
            ])
            ->add( 'date_naissance', DateType::class, [
                'label' => 'Date de naissance',
                'years' => range( 1950, 2010 )
            ])
            ->add( 'description', TextType::class, [
                'label' => 'Qui suis-je?'
            ])
            ->add( 'photo', TextType::class, [
                'label' => 'Photo'
            ])
           
            ->add( 'submit', SubmitType::class, [
                'label' => "S'inscrire"
            ])
        ;

        if ( $this->security->isGranted('ROLE_ADMIN') ) {
             $builder->add( 'statut', ChoiceType::class, [
                'choices' => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                ]
            ] );
       }
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                                   'data_class' => User::class,
                               ]);
    }
}
