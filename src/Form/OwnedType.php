<?php

namespace App\Form;

use App\Entity\Currency;
use App\Entity\Owned;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OwnedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('currency', EntityType::class, array(
            'class' => Currency::class,
            'allow_extra_fields' => true,
            'label' => 'Currency',
            'expanded' =>true ,
           
        ))  
            ->add('quantity')
            ->add('value')
            
             
            ;
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Owned::class,
        ]);
    }
}
