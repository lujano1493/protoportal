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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UsuarioClienteType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('nombre', TextType::class, array('label' => 'Nombre Completo' ,'attr'=> array( 'class' =>  'form-control underlined'  ,'placeholder' =>'Ingresa nombre"'  )  ))
          ->add('apellidos', TextType::class, array('label' => false, 'mapped'=>false, 'attr'=> array( 'class' =>  'form-control underlined'  ,'placeholder' =>'Ingresa apellidos"'  )  ))
          ->add('correo', EmailType::class, array('label' => 'Correo', 'attr'=> array( 'class' =>  'form-control underlined'  ,'placeholder' =>'Ingresa correo"' )) )
          ->add('contrasena', RepeatedType::class, array(
              'type' => PasswordType::class,
              'type' => PasswordType::class,
              'invalid_message' => 'las contraseñas deben ser iguales.',
              'options' => array(),
              'required' => true,
              'first_options'  => array('label' =>  'Contraseña', 'attr'=> array( 'class' =>  'form-control underlined','placeholder' =>'Ingresa contraseña"' )),
              'second_options' => array('label' => false, 'attr'=> array( 'class' =>  'form-control underlined', 'placeholder' =>'Rescribe contraseña"' ))
          ))
          ->add('checarTerminos', CheckboxType::class, array('mapped'=>false ,'label' =>false, 'attr' =>array('class'=>'checkbox'  )  ))
          ->add('registrar', SubmitType::class, array('label' => 'Registrarse', 'attr' => array('class' => 'btn btn-block btn-primary')) ) ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(
          'data_class' => UsuarioCliente::class,
      ));
  }

}
 ?>
