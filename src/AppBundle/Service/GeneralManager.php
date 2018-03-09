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

class GeneralManager{

   protected  $requestStack;
   protected  $request;
   protected  $route;
   protected  $formFactory;
   protected  $twig;
   protected $doctrine;


   public function __construct(
            Environment  $twig,
            RequestStack $requestStack,
            RouterInterface  $route,
            ManagerRegistry $doctrine,
            FormFactoryInterface $formFactory
             )
  {
      $this->requestStack = $requestStack;
      $this->request = $this->requestStack->getCurrentRequest();
      $this->route=$route;
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




}


?>