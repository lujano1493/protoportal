<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;


abstract class GeneralController  extends Controller{





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



}
