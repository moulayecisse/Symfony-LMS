<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add(
                'sub_categories',
                CollectionType::class,
                [
                    'entry_type' => SubCategoryType::class,
                    'entry_options' => [
                        'label' => false,
                        'attr' => [
                            'class' => 'form-control m-input',
                            'autocomplete' => 'off',
                        ]
                    ],
                    'by_reference' => false,
                    // this allows the creation of new forms and the prototype too
                    'allow_add' => true,
                    // self explanatory, this one allows the form to be removed
                    'allow_delete' => true,
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }


    public function getBlockPrefix()
    {
        return 'app_category';
    }
}
