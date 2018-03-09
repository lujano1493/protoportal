<?php

  namespace AppBundle\Controller;

  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Translation\TranslatorInterface;
  use Doctrine\ORM\EntityManagerInterface;

  use AppBundle\Service\UserManager;
  use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

  class NimHomeController extends Controller{



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
    return $this->render('demo/login.html.twig',compact("title" ,"error","lastUsername"));

    }

    /**
    *@Route("/envio/{token}")
    **/
    public function activarUsuario($token){




    }

    /**
    *@Route("/envio/{name}")
    **/
    public function envioAction($name, \Swift_Mailer $mailer)
{
    $message = (new \Swift_Message('Hello Email'))
        ->setFrom('nimWebMaster@nim.com')
        ->setTo('lujano14.93@gmail.com')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                "email/registro.twig.html",
                array('name' => $name)
            ),
            'text/html'
        )

    ;

    $mailer->send($message);

    // or, you can also fetch the mailer service this way
    // $this->get('mailer')->send($message);

  return new Response("Correo enviado.");
}





  }


 ?>
