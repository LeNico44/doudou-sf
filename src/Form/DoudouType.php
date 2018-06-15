<?php

namespace App\Form;

use App\Entity\Doudou;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoudouType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Couleur')
            ->add('type', ChoiceType::Class, [
                'choices' => array(
                    "peluche" => "peluche",
                    "poupée" => "poupée",
                    "chiffe" => "chiffe",
                    "non-défini" => "non-défini"
                ),

            ])
            ->add('lieuDecouverte')
            ->add('photo')
            ->add('lat', NumberType::class)
            ->add('lng', NumberType::class)
            ->add('submit', SubmitType::class, [
                "label" => "Envoyer !"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Doudou::class,
        ]);
    }
}
