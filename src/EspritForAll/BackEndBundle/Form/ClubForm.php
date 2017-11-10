<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 10/11/2017
 * Time: 00:55
 */
namespace EspritForAll\BackEndBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('libelle')
            ->add('description')
            ->add("save", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'esprit_for_fal_back_end_bundle_club_form';
    }
}
