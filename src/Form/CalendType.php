<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Calendar;
use App\Repository\AdRepository;
use App\Repository\CalendarRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CalendType extends AbstractType
{
        private function getconfiguration($label,$placeholder,$options = [] ){
        return array_merge ([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
        }
        private $security;

        public function __construct(Security $security)
        {
            $this->security = $security;
        }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $iduser = $this->security->getUser()->getId();
        
        $builder
            ->add('title',TextType::class , $this->getconfiguration('Titre','Titre du calendrier'))
            ->add('timestart',TimeType::class , $this->getconfiguration("Heure debut","la adtemfknqs",["widget" => "single_text"]))
            ->add('timeend',TimeType::class , $this->getconfiguration("Heure fin","la adtemfknqs",["widget" => "single_text"]))
            ->add('datestart',DateType::class , $this->getconfiguration("Date debut","la adtemfknqs",["widget" => "single_text"]))
            ->add('dateend',DateType::class , $this->getconfiguration("Date fin","la adtemfknqs",["widget" => "single_text"]))
            ->add('decalage_horaire',NumberType::class , $this->getconfiguration('Decalage horaire','30min par exemple'))
           
            ->add('border_color', ColorType::class,[
                'label' => false
            ])
            
            // ->add('ad', EntityType::class,[
            //     'class' => Ad::class,
            //     'label' => false,
            //     'choice_label' => 'name',
            // ])
            //->add('online',CheckboxType::class , $this->getconfiguration('Consultation video ?','Titre du calendrier'))
            //->add('prix',NumberType::class , $this->getconfiguration('Prix','Prix de la consultation video'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}