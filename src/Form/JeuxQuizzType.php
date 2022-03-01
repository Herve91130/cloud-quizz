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
            ->add('Lien')
            ->add('Lien_forum')
            ->add('Image')
            ->add('ImageAlt')
            ->add('themeQuizz_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JeuxQuizz::class,
        ]);
    }
}
