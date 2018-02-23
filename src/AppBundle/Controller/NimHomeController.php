<?php

  namespace AppBundle\Controller;

  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Translation\TranslatorInterface;
  use Doctrine\ORM\EntityManagerInterface;
  use AppBundle\Entity\UsuarioCliente;
  use AppBundle\Form\UsuarioClienteType;

  class NimHomeController extends Controller{


    /**
    * @Route("/registro", name="nim_registro")
    */
    public function registerAction(Request $request){

      $user= new UsuarioCliente();
      $form = $this->createForm( UsuarioClienteType::class, $user ,[ 'action' => $this->generateUrl ('nim_registro') ] );

      $form->handleRequest( $request);

      if( $form->isSubmitted() && $form->isValid()  ){
          $em = $this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();
          //TODO falta enviar correo mensaje de
          return $this->redirectToRoute('/');
      }
      else{
        $title= "Registro de Usuario";
        $form =$form->createView();
       return $this->render('demo/registro.html.twig',compact("title","form"));
      }




    }


  }


 ?>
