<?php

namespace Ephp\UtilityBundle\Form\Seo;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entity_class', null, array('attr' => array('style' => 'width: 300px')))
            ->add('entity_name', null, array('attr' => array('style' => 'width: 300px')))
            ->add('description_base', null, array('attr' => array('style' => 'width: 300px; height: 150px')))
            ->add('keywords_fields', null, array('attr' => array('style' => 'width: 300px; height: 150px')))
            ->add('keywords_min_length')
            ->add('keywords_max_length')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ephp\UtilityBundle\Entity\Seo\Seo'
        ));
    }

    public function getName()
    {
        return 'seo';
    }
}
