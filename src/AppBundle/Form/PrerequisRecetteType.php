<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrerequisRecetteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('item', null, array(
                    'label_attr' => array(
                        'class' => 'd-none',
                    ),
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                    ),
                ))
                ->add('ok', null, array(
                    'label_attr' => array(
                        'class' => 'd-none',
                    ),
                    'attr' => array(
                        'class' => '',
                    ),
                    'required' => true,
                ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Prerequis'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_prerequis_recette';
    }


}
