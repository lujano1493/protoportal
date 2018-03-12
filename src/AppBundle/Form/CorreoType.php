<?php
namespace AppBundle\Form;

use AppBundle\Entity\UsuarioCliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class CorreoType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
      ->add('correo', EmailType::class, array('label' => 'Correo',
        'attr'=> array(
          'class' =>  'form-control underlined' ,
          'placeholder' =>'Ingresa correo'
        ),
        'constraints' => new Assert\Email()
        ) )
       ->add('registrar', SubmitType::class, array('label' => 'Reenviar', 'attr' => array('class' => 'btn btn-block btn-primary')) )  ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(

      ));
  }

}
 ?>
