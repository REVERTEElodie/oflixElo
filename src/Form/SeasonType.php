<?php
// Fichier : SeasonType.php | Date: 2024-01-22 | Auteur: Patrick SUFFREN

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Season;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeasonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number')
            ->add('episodesNumber')
            // on ne demande pas le movie car il est donné quand on veut ajouter une saison pour une série donnée
            // ->add('movie', EntityType::class, [
            //     'class' => Movie::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Season::class,
        ]);
    }
}