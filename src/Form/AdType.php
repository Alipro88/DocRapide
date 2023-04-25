<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\User;
use App\Entity\Ville;
use App\Entity\Category;
use App\Form\ExpertiseType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdType extends AbstractType
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
            ->add('name',TextType::class , $this->getconfiguration('Name','entrer votre nom') )
            ->add('description',TextareaType::class , $this->getconfiguration('Description','entrer votre description') )
            ->add('paiement',TextType::class , $this->getconfiguration('paiement','entrer votre paiement') )
            ->add('adresse',TextType::class, $this->getconfiguration('adresse','entrer votre adresse') )
            ->add('email',EmailType::class, $this->getconfiguration('email','entrer votre email') )
            ->add('langue',TextType::class, $this->getconfiguration('langue','entrer les langues parler') )
            ->add('genre')
            // ->add('Gglmaps',TextType::class, $this->getconfiguration('google maps','entrer le contenu du src dans iframe sur google maps') )
            ->add('facebook',UrlType::class, $this->getconfiguration('Facebook','https://www.facebook.com/') )
            ->add('instagram',UrlType::class, $this->getconfiguration('Instagram','https://www.instagram.com/') )
            // ->add('whatsapp',UrlType::class, $this->getconfiguration('Whatsapp','https://www.web.whatsapp.com/') )
            ->add('twitter',UrlType::class, $this->getconfiguration('Twitter','https://www.twitter.com/') )
            ->add('telephone',TextType::class, $this->getconfiguration('Telephone','entrer votre numéro de téléphone') )
            // ->add('instatoken',TextType::class, $this->getconfiguration('instatoken','Pour générer votre instatoken merci de visiter ce site "https://webkul.com/instatoken/"') )
            // ->add('slug',TextType::class , $this->getconfiguration('Slug','entrer votre slug',[
            //     'required' => false
            // ]))
            ->add('ville', EntityType::class,[
                'class' => Ville::class,
                'choice_label' => 'title',
                'attr' => ['class' => 'chosen-select']
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'title',
                'attr' => ['class' => 'chosen-select']
            ]) 
            ->add('imageFile', FileType::class, [
                'label' => false,
                'attr' => ['class' => 'upload'],
                'required' => false
            ])
            // ->add('longi',TextType::class,[
            //     'label' => false,
            //     'attr' => ['id' => 'long']
            // ])
            // ->add('lat',TextType::class,[
            //     'label' => false,
            //     'attr' => ['id' => 'lat']
            // ])
            ->add('author', EntityType::class,[
                'class' => User::class,
                'choice_label' => 'firstname',
                'attr' => ['class' => 'chosen-select']
            ])
            ->add('expertises',CollectionType::class,
            [
                'entry_type' => ExpertiseType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('diplomes', CollectionType::class,
            [
                'entry_type' => DiplomeType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('genre', ChoiceType::class, [
                'choices'  => [
                    'Genre' => 0,
                    'Homme' => 1,
                    'Femme' => 2,
                ],
                'attr' => ['class' => 'chosen-select']
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}