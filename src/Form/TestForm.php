<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\MoneyType;
//use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
		$widget_css	= 'form-control form-control-sm';

        $builder
			->add('name', TextType::class, ['attr' => ['class'=> $widget_css], 'required' => false ] )
		;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
