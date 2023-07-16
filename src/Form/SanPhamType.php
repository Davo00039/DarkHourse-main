<?php

namespace App\Form;

use App\Entity\SP;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SanPhamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name',TextType::class)
            ->add('Gia',NumberType::class)
            ->add('photo',FileType::class, 
                    array('label' => 'photo (png, jpeg)',
                    'data_class' => null,
                    'required' => false
                ),
    
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SP::class,
        ]);
    }
}
