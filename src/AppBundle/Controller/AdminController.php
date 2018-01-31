<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\User;


class AdminController extends Controller
{


  /**
  * 
  * @Route("/admin/index/{slug}", name="admin_index", defaults= {"slug"=0},methods={"GET"} ) 
  */   
   public function index ($slug){


      return new Response("index_admin: $slug");

   }


   /**
   * @Route("/admin/test_asset")
   */

   public function testAsset(){

      return $this->render("admin/admin.html.twig",[]);
   }

    /**
   * @Route("/admin/dashboard")
   */

   public function indexDashBoard(){
    
      return $this->render("admin/dashboard.html.twig",[]);
   }

  /**
   * @Route("/admin/signup")
   */

   public function indexSignup(){
    
      return $this->render("admin/signup.html.twig",[]);
   }


   /**
   *@Route("/admin/create")
   */

   public function indexCreate(){
     $em = $this->getDoctrine()->getManager();
     $user= new User();

     $user->setNombre("fernando");
     $user->setPaterno("lujano");
     $user->setMaterno("gutierrez");
     $user->setCorreo("lujano14.93@gmail.com");
     $user->setcontrasena("QQ");
     $user->setNickname("lujano144");
     $user->setTelefono("gutierrez");
     $user->setMontoInicial(150.32);
     $user->setCp("57500");
     $user->setPais("57500");
     
      
      $em->persist($user);
      $em->flush();
      return new Response("Creado usuario." . $user->getId());
   }

    /**
    *@Route("/admin/show/{id}", defaults= {"id" =1 })
    */
   public function indexShow($id){
     $repository = $this->getDoctrine()->getRepository( User::class );

     $user= $repository->find($id);
      
      if(!$user){
        throw $this->CreateNotFoundException("No user found for id ". $id);
      }
      
      return new Response("usuario encontrado ." . $user->getId());
   }





}
