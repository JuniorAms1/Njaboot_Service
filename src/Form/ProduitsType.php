<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProd')
            ->add('descProd')
            ->add('prixHt', MoneyType::class,[
                'currency' => 'XAF',
            ])
            ->add('prixTTC',MoneyType::class,[
                'currency' => 'XAF',
                'label' => 'Prix Livraison'
            ])
            ->add('etat', ChoiceType::class, [
                'choices'  => [
                    'En Stock' => 'En Stock',
                    'En Rupture' => 'En Rupture',
                    
                    
                ],
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'empty_data' => ''
                
        ])
            ->add('categorie', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'nom'
        ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
