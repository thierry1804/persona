<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nom', TextType::class, array(
                    'required' => false,
                    'label' => 'NOM :',
                    'label_attr' => array(
                        'class' => 'col-form-label col-4 text-right'
                    ),
                    'attr' => array(
                        'placeholder' => 'Nom',
                        'class' => 'form-control'
                    )
                ))
                ->add('prenom', TextType::class, array(
                    'required' => false,
                    'label' => 'PRENOM :',
                    'label_attr' => array(
                        'class' => 'col-form-label col-4 text-right'
                    ),
                    'attr' => array(
                        'placeholder' => 'Prénom',
                        'class' => 'form-control'
                    )
                ))
                ->add('login', TextType::class, array(
                    'required' => true,
                    'mapped' => false,
                    'label' => 'LOGIN :',
                    'label_attr' => array(
                        'class' => 'col-form-label col-4 text-right'
                    ),
                    'attr' => array(
                        'placeholder' => 'Login',
                        'class' => 'form-control'
                    )
                ))
                ->add('email', EmailType::class, array(
                    'required' => true,
                    'label' => 'EMAIL :',
                    'label_attr' => array(
                        'class' => 'col-form-label col-4 text-right'
                    ),
                    'attr' => array(
                        'placeholder' => 'Email',
                        'class' => 'form-control'
                    )
                ))
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'options' => array('attr' => array('class' => 'form-control', 'placeholder' => 'Entrez mot de passe'), 'label_attr' => array('class' => 'col-form-label col-4 text-right')),
                    'required' => true,
                    'first_options' => array(
                        'label' => 'MOT DE PASSE :',
                    ),
                    'second_options' => array(
                        'label' => 'CONFIRMATION MOT DE PASSE :',
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Utilisateur',
            'allow_extra_fields' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_utilisateur';
    }


}
