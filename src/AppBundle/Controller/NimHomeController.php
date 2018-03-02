<?php

  namespace AppBundle\Controller;

  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Translation\TranslatorInterface;
  use Doctrine\ORM\EntityManagerInterface;
  use AppBundle\Entity\UsuarioCliente;
  use AppBundle\Entity\CatalogoGeoIpPais;
  use AppBundle\Form\UsuarioClienteType;
  use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
  use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

  class NimHomeController extends Controller{







    /**
    * @Route("/registro", name="nim_registro")
    */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder,\Swift_Mailer $mailer){

      $user= new UsuarioCliente();
      $form = $this->createForm( UsuarioClienteType::class, $user ,[ 'action' => $this->generateUrl ('nim_registro') ] );

      $form->handleRequest( $request);

      if( $form->isSubmitted() && $form->isValid()  ){
          $ip =$request->getClientIp();
          $code_contry= geoip_country_code_by_name($ip);
          $em = $this->getDoctrine()->getManager();
          $apellidos =$form->get("apellidos")->getData();

          $lista =preg_split("/[\s,]+/",  $apellidos );
          $user->setPaterno($lista[0]);
          $size=count($lista);
          if($size > 1 ){
            $otherLastName= "";
            for( $index=1;$index< $size ; $index++  ) {
              $otherLastName=  $otherLastName . ' '. $lista[$index];
            }
            $user->setMaterno($otherLastName);
          }
          $name= $user->getNombre() .' '.$apellidos  ;


          $password = $passwordEncoder->encodePassword($user, $user->getContrasena());
          $user->setContrasena($password);

          $em->persist($user);
          $em->flush();
          $message = (new \Swift_Message('Bienvenido'))
           ->setFrom('webmasternim4@gmail.com')
           ->setTo('lujano14.93@gmail.com')
           ->setBody(
               $this->renderView(
                   'email/registro.twig.html',
                   compact("name")
               ),
               'text/html'
           )
       ;

        $mailer->send($message);
        return $this->redirectToRoute('home');
      }
      else{
        $title= "Registro de Usuario";
        $form =$form->createView();
       return $this->render('demo/registro.html.twig',compact("title","form"));
      }
    }

    /**
    *@Route("/login", name="nim_login" )
    **/
    public function loginAction(Request $request, AuthenticationUtils $authUtils){
    $title="Login NIM";

      // get the login error if there is one
    $error = $authUtils->getLastAuthenticationError();

    var_dump($error); die;

    // last username entered by the user
    $lastUsername = $authUtils->getLastUsername();
    return $this->render('demo/login.html.twig',compact("title" ,"error","lastUsername"));

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
