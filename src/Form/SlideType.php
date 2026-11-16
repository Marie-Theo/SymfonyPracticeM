<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Slide;
use App\Entity\SlideShow;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SlideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('content', TextareaType::class)
            ->add('position')
            ->add('image', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'id',
            ])
            ->add('slide_show', EntityType::class, [
                'class' => SlideShow::class,
                'empty_data' => 'Aucun diaporama de créer',
                'choice_label' => static function (SlideShow $slideShow): string {
                    return trim($slideShow->getId() . ' : ' . $slideShow->getTitle());
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Slide::class,
        ]);
    }
}
