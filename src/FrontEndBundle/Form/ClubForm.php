<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 10/11/2017
 * Time: 00:55
 */
namespace FrontEndBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',TextType::class,array('label' => 'Libelle', 'attr' => array(
                'required' => true)))
            ->add('description',TextType::class, array('label' => 'Description', 'attr' => array('placeholder'=>"Description", 'required' => true)))
            ->add('pathImg')
            ->add('pathCouverture')
            ->add('Apropos',TextType::class,array('label' => 'Apropos', 'attr' => array('placeholder'=>"Apropos",'required' => true)))
            ->add('notreHistoire',TextType::class, array('label' => 'Histoire', 'attr' => array('placeholder'=>"Histoire", 'required' => true)))
            ->add("Enregistrer", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false
        ));
    }

    public function getBlockPrefix()
    {
        return 'front_end_bundle_club_form';
    }
}
