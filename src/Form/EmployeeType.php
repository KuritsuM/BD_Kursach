<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Position;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('telephone')
            ->add('email')
            ->add(
                'positions', EntityType::class, array(
                    'class' => Position::class,
                    'expanded' => "true",
                    'multiple' => "true"
                )
            )
            ->add('employeeInfo', EmployeeInfoType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
