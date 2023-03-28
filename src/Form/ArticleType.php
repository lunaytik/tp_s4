<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Fournisseur;
use App\Repository\FournisseurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $codePostal = $options['codePostal'];
        $builder
            ->add('designation', TextType::class, [
                'attr' => ['maxlength' => 5],
                'row_attr' => [
                    'class' => 'col'
                ],
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 5,
                        'exactMessage' => 'La désignation doit faire exactement {{ limit }} caractères',
                    ])
                ]
            ])
            ->add('description', TextType::class, [
                'row_attr' => [
                    'class' => 'col'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'La description ne doit pas être vide'])
                ],
                'required' => false
            ])
            ->add('prix', NumberType::class, [
                'row_attr' => [
                    'class' => 'col'
                ]
            ])
            ->add('quantiteDisponible', IntegerType::class, [
                'row_attr' => [
                    'class' => 'col'
                ]
            ])
            ->add('fournisseur', EntityType::class, [
                'row_attr' => [
                    'class' => 'w-50'
                ],
                'class' => Fournisseur::class,
                'choice_label' => 'libelle',
                'query_builder' => function (FournisseurRepository $fr) use ($codePostal) {
                    return $fr->createQueryBuilder('f')
                        ->join('f.adresse', 'a')
                        ->where('a.codePostal = :codePostal')
                        ->setParameter('codePostal', $codePostal);
                }
            ])
            ->add('tags', CollectionType::class, [
                'entry_type' => TagType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'codePostal' => null
        ]);
    }
}
