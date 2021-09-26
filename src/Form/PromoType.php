<?php

namespace App\Form;

use App\Entity\Produits;
use App\Entity\Promo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut')
            ->add('dateFin')
            ->add('descPromo')
            ->add('prixPromo')
            ->add('produits', EntityType::class, [
                'class' => Produits::class,
                'choice_label' => 'id'
        ])
        ;
       }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Promo::class,
        ]);
    }
}
