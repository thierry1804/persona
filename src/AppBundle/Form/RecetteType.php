<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RecetteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('numero', null, array(
                    'label' => 'Cas de test',
                    'label_attr' => array(
                        'class' => 'col-sm-2 col-form-label',
                    ),
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => false,
                ))
                ->add('titre', null, array(
                    'label_attr' => array(
                        'class' => 'col-sm-2 col-form-label',
                    ),
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => false,
                ))
                ->add('objectif', null, array(
                    'label_attr' => array(
                        'class' => 'col-sm-2 col-form-label',
                    ),
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => false,
                ))
                ->add('prerequis', CollectionType::class, array(
                    'label' => 'Prérequis',
                    'label_attr' => array(
                        'class' => 'col-sm-2 col-form-label',
                    ),
                    'attr' => array(
                        'readonly' => $options['readonly'],
                    ),
                    'required' => true,
                    'entry_type' => PrerequisRecetteType::class,
                    'entry_options' => array(
                        'label' => false,
                    ),
                ))
                ->add('initialisation', null, array(
                    'label_attr' => array(
                        'class' => 'col-sm-2 col-form-label',
                    ),
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => false,
                ))
                ->add('batteries', CollectionType::class, array(
                    'label' => 'Batteries',
                    'label_attr' => array(
                        'class' => 'col-sm-2 col-form-label',
                    ),
                    'attr' => array(
                        'readonly' => $options['readonly'],
                    ),
                    'required' => true,
                    'entry_type' => BatterieRecetteType::class,
                    'entry_options' => array(
                        'label' => false,
                    ),
                ))
                ->add('critereSuccesEchec', EntityType::class, array(
                    'label' => 'Critère de succès / échec',
                    'attr' => array(
                        'readonly' => $options['readonly'],
                    ),
                    'class' => 'AppBundle:CritereSuccesEchec',
                    'choice_label' => function($critereSuccesEchec) {
                        return '<u><strong style="color: ' . $critereSuccesEchec->getCouleur() . ';">' . ucwords($critereSuccesEchec->getNiveau()) . '</strong></u>: ' . $critereSuccesEchec->getDescription() . "\n";
                    },
                    'expanded' => true,
                    'multiple' => false,
                ))
                ->add('commentaire', null, array(
                    'label_attr' => array(
                        'class' => 'col-sm-2 col-form-label',
                    ),
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => false,
                ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CasTest',
            'readonly' => FALSE,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_recette';
    }


}
