<?php
// src/Form/QuizType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('style', ChoiceType::class, [
                'choices' => [
                    'Aggressif' => 'aggressive',
                    'Stratégique' => 'strategic',
                    'Défensif' => 'defensive',
                ],
                'label' => 'Quel est votre style de pilotage ?',
            ])
            ->add('color', ChoiceType::class, [
                'choices' => [
                    'Rouge' => 'red',
                    'Bleu' => 'blue',
                    'Vert' => 'green',
                    'Jaune' => 'yellow',
                    'Autre' => 'other',
                ],
                'label' => 'Quelle est votre couleur préférée ?',
            ])
            ->add('preRaceRoutine', ChoiceType::class, [
                'choices' => [
                    'Écouter de la musique' => 'music',
                    'Méditer' => 'meditate',
                    "Parler à l'équipe technique" => 'talk_to_team',
                    'Autre' => 'other',
                ],
                'label' => 'Que faites-vous avant une course ?',
            ])
            ->add('experience', ChoiceType::class, [
                'choices' => [
                    'Plusieurs années' => 'experienced',
                    'Quelques courses' => 'intermediate',
                    'Débutant' => 'beginner',
                ],
                'label' => 'Quelle est votre expérience en course ?',
            ]);
    }
}
