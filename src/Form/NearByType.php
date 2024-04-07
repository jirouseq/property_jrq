<?php

namespace App\Form;

use App\Entity\NearBy;
use App\Entity\NearByGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NearByType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nearBy', EntityType::class, [
                'class' => NearBy::class,
                'choice_label' => 'name',
                'label' => 'Místo'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NearByGroup::class
        ]);
    }
}
