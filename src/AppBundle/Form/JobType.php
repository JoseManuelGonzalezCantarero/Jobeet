<?php

namespace AppBundle\Form;

use AppBundle\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'choices_as_values' => true,
                'choices' => Job::getTypes(),
                'expanded' => true
            ))
            ->add('category')
            ->add('company')
            ->add('file', FileType::class, array('label' => 'Company logo', 'required' => false))
            ->add('url', UrlType::class)
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('howToApply', null, array('label' => 'How to apply?'))
            ->add('isPublic', null, array('label' => 'Public?'))
            ->add('email', EmailType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Job'
        ));
    }
}
