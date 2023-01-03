<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Common\Annotations\Annotation\Required;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,

                'attr' => [
                    'placeholder' => "Titre de l'article",
                    'class' => 'flex-1'
                ],
                'row_attr' => [
                    'class' => 'form-group flex'
                ]
            ])
            // ->add('content', TextareaType::class,[
            //     'label' => false,
            //     'required' => false,
            //     'attr' => [
            //         'placeholder' => "Description de l'article", 
            //         'class' => 'flex-1',
            //         'rows' => 15,

            //     ],
            //     'row_attr' => [
            //         'class' => 'form-group flex',
            //     ],
            // ])
            ->add('content', CKEditorType::class)
            ->add('imageFile', FileType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Titre de l'article",
                    'class' => 'flex-1'
                ],
                'row_attr' => [
                    'class' => 'form-group '
                ]
            ])
            ->add('categories', EntityType::class, [
                'label' => false,
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'by_reference' => false,
                'attr' => [
                    'placeholder' => "Titre de l'article",
                    'class' => 'flex-1 choices_categories'
                ],
                'row_attr' => [
                    'class' => 'form-group '
                ]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
