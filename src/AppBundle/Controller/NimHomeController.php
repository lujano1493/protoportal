<?php

  namespace AppBundle\Controller;

  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Translation\TranslatorInterface;
  use Doctrine\ORM\EntityManagerInterface;
  use AppBundle\Form\CorreoType;
  use AppBundle\Form\RecuperarContrasenaType;

  use AppBundle\Service\UserManager;
  use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
  use AppBundle\Entity\Ticket;
  use AppBundle\Entity\UsuarioCliente;
  use AppBundle\Util\SerializeFactory;

  class NimHomeController extends GeneralController{



    /**
    * @Route("/registro", name="nim_registro")
    */
    public function registerAction(UserManager $userManager   ){

        return $userManager->createUser();
    }

    /**
    *@Route("/login", name="nim_login" )
    **/
    public function loginAction(Request $request, AuthenticationUtils $authUtils){
    $title="Login NIM";

      // get the login error if there is one
    $error = $authUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authUtils->getLastUsername();
    return $this->render('nim/login.html.twig',compact("title" ,"error","lastUsername"));

    }

    /**
    *@Route("/activar/{token}" , name="activa_cuenta_nim")
    **/
    public function activarUsuarioAction($token){

        if(!$token){
          $this->error("Es necesario ingresar token de activación.");
          return $this->redirectToRoute("home");
        }
        $em=$this->getDoctrine()->getManager();
        $repository = $em->getRepository(Ticket::class);
        $ticket=$repository->loadTiketByToken($token);

        if(!$ticket ||  $ticket->getTipo() !==  Ticket::TIPO_ACTIVA_CUENTA_NIM   ){
          $this->error("No fue posible encontrar ticket intente reenviando correo.");
          return $this->redirectToRoute("home");
        }

        $repository = $em->getRepository(UsuarioCliente::class);
        $json=$ticket->getParametro();
        $userArray = json_decode( $json  );
        $user= $repository->find( $userArray->id  );
        $user->setEstatus(1);
        $em->persist( $user);
        $em->remove( $ticket);
        $em->flush();
        $this->success("Su cuenta de usuario ha sido activada. Ahora ya puede ingresar a su cuenta de NIM.");
        return $this->redirectToRoute('nim_profile', ['keyCode' =>$user->getKeyCode(),200  ]);
    }

    /**
    * @Route("/reenviar_correo" , name="reenviar_correo_nim"  )
    *
    **/
    public function reenviarCorreoAction(Request $request , UserManager $userManager){
      $title= "Reenviar Correo";
      $defaultData= [ "correo" => "" ];
      $form = $this->createForm(  CorreoType::class ,$defaultData, [ 'action' => $this->generateUrl ('reenviar_correo_nim') ] );
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        if($userManager->sendEmail( $data['correo'] )){
          $this->success("Se ha reenviado el correo de activación.");
        }
          return $this->redirectToRoute('home');


      }
      else{
          $form =$form->createView();
          return $this->render( "nim/reenviarcorreo.html.twig",compact("title", "form")  );
      }

    }

    /**
    * @Route("/recuperar_contrasena" , name="recuperar_contrasena_nim"  )
    *
    **/
    public function recuperarContrasenaAction(Request $request , UserManager $userManager){

      $title= "Recuperar Contrasena";
      $defaultData= [ "correo" => "" ];
      $form = $this->createForm(  CorreoType::class ,$defaultData, [ 'action' => $this->generateUrl ('recuperar_contrasena_nim') ] );
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        if($userManager->recuperarContrasena( $data['correo'] )){
          $this->success("Se ha enviado un correo para recuparación de contraseña.");
        }
        return $this->redirectToRoute('home');
      }
      else{
          $form =$form->createView();
          return $this->render( "nim/recuperar_contrasena.html.twig",compact("title", "form")  );
      }


    }

    /**
    * @Route("/restablecer_contrasena/{token}" , name="restablece_contrasena_nim"  )
    *
    */

    public function restablecerContrasenaAction($token ,Request $request , UserManager $userManager){


      if(!$token){
        $this->error("Es necesario ingresar token de recuperación de contraseña.");
        return $this->redirectToRoute("home");
      }
      $em=$this->getDoctrine()->getManager();
      $repository = $em->getRepository(Ticket::class);
      $ticket=$repository->loadTiketByToken($token);

      $title= "Restablecer Contraseña";
      $defaultData= [ "correo" => "" ];
      $form = $this->createForm(
          RecuperarContrasenaType::class ,
          $defaultData,
          [
              'action' => $this->generateUrl (
                  'restablece_contrasena_nim' ,
                  compact('token')
                  )
          ]
        );
      $form->handleRequest($request);
      if(!$ticket ||  $ticket->getTipo() !==  Ticket::TIPO_REESTABLECER_CONTRASENA_NIM   ){
        $this->error("No fue posible encontrar ticket para recuperar contraseña. Intente nuevamente enviando un correo");
        return $this->redirectToRoute("home");
      }

      if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        //userManager->recuperarContrasena( $data['correo'] );
        $repo = $em->getRepository( UsuarioCliente::class);
        $user= $repo ->find(  $ticket->getIdEntidad() );
        $user->setContrasena(  $data['contrasena'] );
        $em->remove( $ticket);
        $em->flush();
        $this->success("Se ha restablecido su contraseña.");
        return $this->redirectToRoute('home');
      }
      else{
          $form =$form->createView();
          return $this->render( "nim/restablece_contrasena.html.twig",compact("title", "form")  );
      }

    }




  }


 ?>
