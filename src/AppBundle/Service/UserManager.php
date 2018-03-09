<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\UsuarioCliente;
use AppBundle\Form\UsuarioClienteType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserManager  extends  GeneralManager{


   protected  $passwordEncoder;
   protected  $mailer;


  public function createUser(){
    $user= new UsuarioCliente();
    $form = $this->createForm( UsuarioClienteType::class, $user ,[ 'action' => $this->generateUrl ('nim_registro') ] );
    $form->handleRequest( $this->request);
    $em = $this->getDoctrine()->getManager();
    if( $form->isSubmitted() && $form->isValid()  ){     

        /**
          * Librerioa geoIP  para obtener datos de obicacion de usuario 
          * para informacion de instalcion y configuracion visite la siguiente pagina
          * http://php.net/manual/es/book.geoip.php
          */
        $ip =$this->request->getClientIp();
        $code_contry= geoip_country_code_by_name($ip);
        $user->getPaisCodigo(  $code_contry );
        /** Fin de invocacion de obtencion de codigo por pais  */

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();


        $name= $user->getNombre() .' '.$user->getApellidos()  ;

        $message = (new \Swift_Message('Bienvenido'))
         ->setFrom('webmasternim4@gmail.com')
         ->setTo(  $user->getCorreo()  )
         ->setBody(
             $this->renderView(
                 'email/registro.twig.html',
                 compact("name")
             ),
             'text/html'
         )
     ;

      $this->mailer->send($message);
      return $this->redirectToRoute('home');
    }
    else{
      $title= "Registro de Usuario";
      $form =$form->createView();
     return $this->render('demo/registro.html.twig',compact("title","form"));
    }

  }

  /**
  * @required
  */
  public function setPasswordEncoder(UserPasswordEncoderInterface $passwordEncoder){
    $this->passwordEncoder= $passwordEncoder;
  }

  /**
  * @required
  */
  public function setMailer( \Swift_Mailer $mailer   ){
    $this->mailer= $mailer;
  }


}


?>
