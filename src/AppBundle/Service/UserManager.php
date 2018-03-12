<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\UsuarioCliente;
use AppBundle\Form\UsuarioClienteType;



class UserManager  extends  GeneralManager{

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
      return $this->redirectToRoute('home');
    }
    else{
      $title= "Registro de Usuario";
      $form =$form->createView();
     return $this->render('demo/registro.html.twig',compact("title","form"));
    }

  }

  public function  sendEmail($correo) {

    $em=$this->getDoctrine()->getManager();
    $repo= $em->getRepository( UsuarioCliente ::class  );

    $user= $repo->findOneByCorreo(  $correo );
    if($user ===NULL  ){
      throw $this->createNotFoundException(
       'No existe correo en el sistema'
      );
    }

    if( $user->getEstatus() !== 0  ){
      throw $this->createNotFoundException(
       'La cuenta de correo ya se encuentra activa.'
      );
    }
    $array=  $user->generarArray();
    $this->createToken(Ticket::TIPO_ACTIVA_CUENTA_NIM ,$user->getId() ,$array,$user->getCorreo());

  }

  public function  recuperarContrasena($correo) {

    $em=$this->getDoctrine()->getManager();
    $repo= $em->getRepository( UsuarioCliente ::class  );

    $user= $repo->findOneByCorreo(  $correo );
    if($user ===NULL  ){
      throw $this->createNotFoundException(
       'No existe correo en el sistema.'
      );
    }
    $array=  $user->generarArray();
    $this->createToken(Ticket::TIPO_REESTABLECER_CONTRASENA_NIM ,$user->getId() ,$array,$user->getCorreo());

  }




}


?>
