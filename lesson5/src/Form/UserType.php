<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'Введите имя',
                'attr' => array(
                    'placeholder' => 'имя',
                )
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Введите фамилию',
                'attr' => array(
                    'placeholder' => 'фамилия',
                )
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Введите email',
                'attr' => array(
                    'placeholder' => 'email',
                )
            ))
  //          ->add('roles')
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array(
                    'label' => 'Пароль',
                ),
                'second_options' => array(
                    'label' => 'Повтор пароля',
                )
            ))
        ->add('save', SubmitType::class, array(
            'label' => 'сохранить',
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
