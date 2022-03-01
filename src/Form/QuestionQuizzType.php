<?php

namespace App\Form;

use App\Entity\QuestionQuizz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionQuizzType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question')
            ->add('choix1')
            ->add('choix2')
            ->add('choix3')
            ->add('choix4')
            ->add('reponse')
            ->add('jeux_quizz')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuestionQuizz::class,
        ]);
    }
}
