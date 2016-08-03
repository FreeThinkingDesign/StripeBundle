<?php

namespace WMC\StripeBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CardFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('card', TextType::class, array(
                    'required' => true,
                    'attr' => array('data-stripe' => 'number'),
                    'label' => 'form.card.number',
                    'translation_domain' => 'WMCStripeBundle',
                )
            )
            ->add('cvc', IntegerType::class, array(
                    'required' => true,
                    'attr' => array('data-stripe' => 'cvc'),
                    'label' => 'form.card.cvc',
                    'translation_domain' => 'WMCStripeBundle',
                )
            )
            ->add(
                'month',
                ChoiceType::class,
                array(
                    'required' => true,
                    'attr' => array('data-stripe' => 'exp-month'),
                    'choices' => array_combine(range(1, 12), range(1, 12)),
                    'label' => 'form.card.exp.month',
                    'translation_domain' => 'WMCStripeBundle',
                )
            )
            ->add(
                'year',
                ChoiceType::class,
                array(
                    'required' => true,
                    'attr' => array('data-stripe' => 'exp-year'),
                    'choices' => array_combine(range(date('Y'), date('Y') + 10), range(date('Y'), date('Y') + 10)),
                    'label' => 'form.card.exp.year',
                    'translation_domain' => 'WMCStripeBundle',
                )
            )
            ->add('token', HiddenType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array()
        );
    }

    public function getName()
    {
        return 'wmc_stripebundle_cardformtype';
    }
}
