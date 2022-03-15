<?php

namespace App\Form;

use App\Entity\JeuxQuizz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JeuxQuizzType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Jeux')
            ->add('Image')
            ->add('ImageAlt')
            ->add('themeQuizz')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JeuxQuizz::class,
        ]);
    }
}
