<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 14/11/2017
 * Time: 23:13
 */
namespace EspritForAll\BackEndBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EvenementForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('libelle')
            ->add('type')
            ->add('Club',EntityType::class,array('class'=>'EspritForAllBackEndBundle:Club','multiple'=>false,'choice_label'=>'Libelle'))
            ->add('description')
            ->add('date')
            ->add('pathImg')
            ->add("Enregistrer", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'esprit_for_fal_back_end_bundle_evenement_form';
    }
}