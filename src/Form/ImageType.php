<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImageType extends AbstractType
{



    /**
     * Permet la configuration de base d'un champ
     *
     * @param [type] $label
     * @param [type] $placeholder
     *
     * @return array
     */
    private function getConfiguration($placeholder)
    {
        return [
            
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class,
                $this->getConfiguration("Url de l'image")
            )
            ->add('caption', TextType::class,
            $this->getConfiguration("Titre de l'image")
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
