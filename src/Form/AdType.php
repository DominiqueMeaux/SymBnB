<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends AbstractType
{

    /**
     * Permet la configuration de base d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    private function getConfiguration($label, $placeholder, $options = [])
    {
        // array_merge permet la fusion du tableau contenant
        // le label et placeholder avec le tableau des options
        // qui peut être null par defaut
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }


    /**
     * Formulaire d'ajout d'une annonce
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                $this->getConfiguration("titre", "Taper un titre pour votre annonce")
            )

            ->add(
                'slug',
                TextType::class,
                $this->getConfiguration("Adresse web", "Taper l'adresse web (automatique)", [
                    'required' => false
                ])
            )

            ->add(
                'introduction',
                TextType::class,
                $this->getConfiguration("Introduction", "Tapez une description globale de l'annonce")
            )

            ->add(
                'content',
                TextareaType::class,
                $this->getConfiguration("Déscription détaillée", "Tapez une description qui donne vraiment envie de venir chez vous !")
            )

            ->add(
                'coverImage',
                UrlType::class,
                $this->getConfiguration("Url de l' image", "Tapez l'adresse de l image")
            )

            ->add(
                'rooms',
                IntegerType::class,
                $this->getConfiguration("Nombre de chambre", "Nombre de chambre disponible")
            )

            ->add(
                'price',
                MoneyType::class,
                $this->getConfiguration("Prix par nuit", "Indiquer le prix pour une nuit")
            )

            ->add(
                'images',
                CollectionType::class,
                [
                    // entry_type = type des entrées de cette collection
                    'entry_type' => ImageType::class,
                    // allow_add permet de préciser si l'on a le droit d'ajouter de nouveaux éléments
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            );
    }


    /**
     * Undocumented function
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
