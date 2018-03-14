<?php
namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\UsuarioCliente;
use AppBundle\Entity\Ticket;
use AppBundle\Form\UsuarioClienteType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;
use Doctrine\Common\Persistence\ManagerRegistry;

class GeneralManager{

   protected  $requestStack;
   protected  $request;
   protected  $session;
   protected  $route;
   protected  $formFactory;
   protected  $twig;
   protected $doctrine;

   public function __construct(
            Environment  $twig,
            RequestStack $requestStack,
            SessionInterface $session,
            RouterInterface  $route,
            ManagerRegistry $doctrine,
            FormFactoryInterface $formFactory
             )
  {
      $this->requestStack = $requestStack;
      $this->session = $session;
      $this->request = $this->requestStack->getCurrentRequest();
      $this->route=$route;
      $this->FormFactory=$formFactory;
      $this->twig=$twig;
      $this->doctrine=$doctrine;
  }


  protected function addFlash($type, $message)
     {
         $this->session->getFlashBag()->add($type, $message);
     }

  protected function  notice($message){
    $this->addFlash( 'notice', $message  );
  }

  protected function  success($message){
    $this->addFlash( 'success', $message  );
  }
  protected function  warning($message){
    $this->addFlash( 'warning', $message  );
  }

  protected function  error($message){
    $this->addFlash( 'danger', $message  );
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

   /**
  * Returns a NotFoundHttpException.
  *
  * This will result in a 404 response code. Usage example:
  *
  *     throw $this->createNotFoundException('Page not found!');
  *
  * @param string          $message  A message
  * @param \Exception|null $previous The previous exception
  *
  * @return NotFoundHttpException
  *
  * @final since version 3.4
  */
 protected function createNotFoundException($message = 'Not Found', \Exception $previous = null)
 {
     return new NotFoundHttpException($message, $previous);
 }



   public function createToken($tipo,$idEntidad,$array =[],$extra ='' ){

     $entityManager = $this->getDoctrine()->getManager();

     $repo =$entityManager->getRepository( Ticket::class   );

    /* Eñliminamos token anteriores  */
     $repo->createQueryBuilder("t")
          ->delete()
          ->where( " t.idEntidad = :idEntidad" )
          ->setParameter("idEntidad" ,  $idEntidad)
          ->getQuery()
          ->execute();

     $ticket = new Ticket();
     $ticket->setTipo( $tipo );
     $ticket->setIdEntidad( $idEntidad );
     $json= json_encode($array);
     $ticket->setParametro($json);
     $token = $this->generateKeySecurity(Ticket::class,'token',$extra  );
     $ticket->setToken( $token );
     $entityManager->persist( $ticket  );
     $entityManager->flush();
   }

   /**
   * Funcion necesaria para generar un token de seguridad
   */

   public function generateKeySecurity( $clazz, $field ,  $extra =''  ,$unique=true ){
           $repo=  $this->getDoctrine()->getManager()->getRepository(   $clazz  );
           $keySecurity =   hash("sha512",random_bytes(5) . $extra);
           if( $unique &&  $repo->hasAny(  [  $field => $keySecurity   ]   )  ){
               $keySecurity= $this->generateKeySecurity( $class,$field, $extra,true  );
           }
           return $keySecurity;
   }



}


?>
