<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Project;
use App\Entity\Technology;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'     => 'Nom',
                'required'  => true,
            ])
            ->add('link', TextType::class, [
                'label' => 'Lien',
            ])
            ->add('category', EntityType::class, [
                'choice_label'  => 'name',
                'class'         => Category::class,
            ])
            ->add('technologies', EntityType::class, [
                'choice_label' => 'name',
                'label_attr' => [
                    'class' => 'checkbox-custom',
                ],
                'class' => Technology::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('description')
            ->add('poster')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
