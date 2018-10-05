<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BatterieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('donneesEntrees', null, array(
                    'label_attr' => array(
                        'class' => 'd-none',
                    ),
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                    ),
                    'required' => true,
                ))
                ->add('comportementAttendu', null, array(
                    'label_attr' => array(
                        'class' => 'd-none',
                    ),
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                    ),
                    'required' => true,
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Batterie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_batterie';
    }


}
