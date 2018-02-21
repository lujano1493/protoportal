<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

class DemoController extends Controller
{

    /**
      * @Route("/demo/theme")
    */

    public function actionTemplate(Request $request){
      $param= $request->get("opc");
 		$title= "Template ";
        // replace this example code with whatever you need
        return $this->render('demo/theme.html.twig', compact("title"));
    }



     /**
      * @Route("/demo/")
    */

    public function actionIndex(Request $request){
      $param= $request->get("opc");
        $title= "Demo ";
        // replace this example code with whatever you need
        return $this->render('demo/inicio.html.twig', compact("title"));
    }

    /**
		*@Route("/demo/registro")
    */
	public function actionRegistro(Request $request){
      var_dump( $this );
       die;
		 $title= "Registro de Usuario";

		return $this->render('demo/registro.html.twig',compact("title"));

	}


}
