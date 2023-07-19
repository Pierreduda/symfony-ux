<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('city', ChoiceType::class, [
//                'choices' => [
//                    'Anger' => 'anger',
//                    'Paris' => 'paris',
//                    'Lyon' => 'lyon',
//                    'Rennes' => 'rennes',
//                    'Marseille' => 'marseille'
//                ],
//                'autocomplete' => true,
//                'placeholder' => "Choisissez une ville"
//            ]);
//            ->add('city', EntityType::class, [
//                'class' => City::class,
//                'autocomplete' => true,
//            ]);
            ->add('name', TextType::class)
            ->add('city', CityAutocompleteField::class)
        ->add('submit', SubmitType::class, [
            'label' => 'Enregistrer'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
