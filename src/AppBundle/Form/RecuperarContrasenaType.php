<?php
namespace AppBundle\Form;

use AppBundle\Entity\UsuarioCliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RecuperarContrasenaType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('contrasena', RepeatedType::class, array(
              'type' => PasswordType::class,
              'invalid_message' => 'las contraseñas deben ser iguales.',
              'options' => array(),
              'required' => true,
              'first_options'  => array('label' =>  'Contraseña', 'attr'=> array( 'class' =>  'form-control underlined','placeholder' =>'Ingresa contraseña' )),
              'second_options' => array('label' => false, 'attr'=> array( 'class' =>  'form-control underlined', 'placeholder' =>'Confirmar contraseña' ))
          ))
          ->add('restablecer', SubmitType::class, array('label' => 'Restablecer', 'attr' => array('class' => 'btn btn-block btn-primary')) );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(

      ));
  }

}
 ?>
