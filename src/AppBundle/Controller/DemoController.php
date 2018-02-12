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
      * @Route("/demo/inicio")
    */

    public function actionInicio(Request $request){
      $param= $request->get("opc");

        // replace this example code with whatever you need
        return $this->render('nim.base.html.twig', [ ]);
    }


}
