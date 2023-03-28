<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse1', TextType::class, [
                'label' => 'Adresse',
                'help' => 'Numéro, Rue',
                'attr' => ['class' => 'form-control']
            ])
            ->add('adresse2', TextType::class, [
                'label' => 'Complément Adresse',
                'help' => 'Numéro, Rue',
                'attr' => ['class' => 'form-control']
            ])
            ->add('codePostal', NumberType::class, [
                'label' => 'Code Postal',
                'help' => 'Exemple: 10000',
                'attr' => ['class' => 'form-control', 'maxlength' => 5],
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 5,
                    ]),
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'help' => 'Exemple: Troyes',
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
