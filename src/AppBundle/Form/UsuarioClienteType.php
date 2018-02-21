<?php
namespace AppBundle\Form;

use AppBundle\Entity\UsuarioCliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UsuarioClienteType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('nombre', TextType::class)
          ->add('apellidos', TextType::class)
          ->add('correo', EmailType::class)
          ->add('contrasena', RepeatedType::class, array(
              'type' => PasswordType::class,
              'first_options'  => array('label' => 'Ingresa password'),
              'second_options' => array('label' => 'Rescribe password'),
          ))
          ->add('checarTerminos', CheckboxType::class)
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(
          'data_class' => UsuarioCliente::class,
      ));
  }

}
 ?>
