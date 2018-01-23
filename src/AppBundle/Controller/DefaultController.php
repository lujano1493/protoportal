<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/proximamente", name="commin_soon")
     */
    public function proximamenteAction(Request $request  )
    {

       // $translated = $this->get('translator')->trans('label.test');
       // var_dump($translated);
       // die;

       //$translator->trans('Hola  '.$name);
        return $this->render('proximamente.html.twig',[]);
    }


}
