<?php

  namespace AppBundle\Controller;

  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Translation\TranslatorInterface;
  use Doctrine\ORM\EntityManagerInterface;
  use AppBundle\Entity\UsuarioCliente;
  use AppBundle\Entity\CatalogoGeoIpPais;
  use AppBundle\Form\UsuarioClienteType;
  use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

  class NimUserController extends GeneralController{

      /**
      *@Route("/nim_user/profile", name="nim_profile" )
      **/
      public function profileAction(Request $request, AuthenticationUtils $authUtils){
        $title="Perfil NIM";
        return $this->render('nim/profile.html.twig',compact("title" ));
      }





  }
