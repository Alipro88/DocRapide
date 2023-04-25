<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationProType extends AbstractType
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
            ->add('firstname',TextType::class , $this->getconfiguration(false,'Prénom *') )
            ->add('lastname',TextType::class , $this->getconfiguration(false,'Nom *'))
            ->add('email',TextType::class , $this->getconfiguration(false,'Email *'))
            ->add('introduction',TextType::class , $this->getconfiguration(false,'Code postal cabinet *'))
            ->add('telephone',TextType::class , $this->getconfiguration(false,'Téléphone *'))
            ->add('genre', ChoiceType::class, [
                'choices'  => [
                    'Genre' => 0,
                    'Homme' => 1,
                    'Femme' => 2,
                ],
                'attr' => ['class' => 'chosen-select']
            ])          
            ->add('category', EntityType::class,[
                'label'=> false,
                'class' => Category::class,
                'choice_label' => 'title',
                'attr' => ['class' => 'chosen-select']
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