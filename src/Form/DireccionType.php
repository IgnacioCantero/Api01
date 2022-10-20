<?php

namespace App\Form;

use App\Entity\Clientes;
use App\Entity\Direcciones;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DireccionType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Direcciones::class,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('calle', TextType::class)
            ->add('numero', TextType::class)
            ->add('puertaPisoEscalera', TextType::class)
            ->add('codPostal', NumberType::class)
            //'EntityType::class' para las relaciones:
            ->add('clientes', EntityType::class, ['class'=>Clientes::class])
            ->add('municipio', EntityType::class, ['class'=>Clientes::class])
            ->add('provincia', EntityType::class, ['class'=>Clientes::class])
        ;
    }

    //Por defecto le pone un nombre al formulario -> para dejar vacío dicho nombre:
    public function getBlockPrefix()
    {
        return "";
    }
    public function getName()
    {
        return "";
    }
}
