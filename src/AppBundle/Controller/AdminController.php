<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

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
    
      return $this->render("layout.admin.html.twig",[]);
   }


}
