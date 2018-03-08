<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\UsuarioCliente;
use AppBundle\Form\UsuarioClienteType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;
use Doctrine\Common\Persistence\ManagerRegistry;

class UserManager{

   protected  $requestStack;
   protected  $request;
   protected  $passwordEncoder;
   protected  $mailer;
   protected  $route;
   protected  $formFactory;
   protected  $twig;
   protected $doctrine;


   public function __construct(
            Environment  $twig,
            RequestStack $requestStack,
            RouterInterface  $route,
            FormFactoryInterface $formFactory,
            UserPasswordEncoderInterface $passwordEncoder,
            \Swift_Mailer $mailer,
            ManagerRegistry $doctrine
             )
  {
      $this->requestStack = $requestStack;
      $this->request = $this->requestStack->getCurrentRequest();
      $this->mailer= $mailer;
      $this->route=$route;
      $this->passwordEncoder=$passwordEncoder;
      $this->FormFactory=$formFactory;
      $this->twig=$twig;
      $this->doctrine=$doctrine;
  }

  protected function generateUrl($name, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH){
    return $this->route->generate($name,$parameters,$referenceType);
  }

  protected function createForm($type = 'Symfony\Component\Form\Extension\Core\Type\FormType', $data = null, array $options = array()){
    return $this->FormFactory->create($type,$data,$options);
  }

  protected function renderView($view, array $parameters = array())
  {
      return $this->twig->render($view, $parameters);
  }

  protected function render($view, array $parameters = array(), Response $response = null)
    {
        $content = $this->twig->render($view, $parameters);
        if (null === $response) {
            $response = new Response();
        }
        $response->setContent($content);
        return $response;
  }


  protected function getDoctrine()
   {
       return $this->doctrine;
   }

   protected function redirect($url, $status = 302)
   {
       return new RedirectResponse($url, $status);
   }


   protected function redirectToRoute($route, array $parameters = array(), $status = 302)
   {
       return $this->redirect($this->generateUrl($route, $parameters), $status);
   }

  public function createUser(){
    $user= new UsuarioCliente();
    $form = $this->createForm( UsuarioClienteType::class, $user ,[ 'action' => $this->generateUrl ('nim_registro') ] );

    $form->handleRequest( $this->request);

    $em = $this->getDoctrine()->getManager();
    if( $form->isSubmitted() && $form->isValid()  ){
        $ip =$this->request->getClientIp();
        $code_contry= geoip_country_code_by_name($ip);
        $user->getPaisCodigo(  $code_contry );
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


        $password = $this->passwordEncoder->encodePassword($user, $user->getContrasena());
        $user->setContrasena($password);

        $em->persist($user);
        $em->flush();
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





}


?>
