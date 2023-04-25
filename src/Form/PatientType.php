<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PatientType extends AbstractType
{
    private function getconfiguration($label,$placeholder,$options = [] ){
        return array_merge ([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
   }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class , $this->getconfiguration('Prénom','entrer votre Prénom') )
            ->add('lastname',TextType::class , $this->getconfiguration('Nom','entrer votre nom'))
            ->add('email',TextType::class , $this->getconfiguration('Email','entrer votre email'))
            ->add('telephone',TextType::class , $this->getconfiguration('Numéro de téléphone','entrer votre Numéro de téléphone'))            
            ->add('hash',PasswordType::class , $this->getconfiguration('Mot de passe','entrer votre password'))
            ->add('passwordConfirm',PasswordType::class , $this->getconfiguration('confirmation du mot de passe','veuillez confirmer votre mot de passe'))
            
            ->add('imageFile',FileType::class, [
                'required'   => false,
                'label' => false,
                'attr' => ['class' => 'upload']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
