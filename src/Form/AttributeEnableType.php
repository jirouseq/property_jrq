<?php

namespace App\Form;

use App\Entity\AttributeEnable;
use App\Entity\Attributes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributeEnableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('attributes', EntityType::class, [
                'class' => Attributes::class,
                'choice_label' => 'name',
                'label' => 'Atribut'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AttributeEnable::class
        ]);
    }
}
