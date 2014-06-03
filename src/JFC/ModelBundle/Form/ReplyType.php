<?php
// src/JFC/ModelBundle/Form/ReplyType.php

namespace JFC\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ReplyType
 */
class ReplyType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('body')
            ->add('post', 'submit');
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JFC\ModelBundle\Entity\Reply'
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'jfc_modelbundle_reply';
    }
}
