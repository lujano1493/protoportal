<?php
namespace AppBundle\Listener;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Ticket;
use AppBundle\Service\GeneralManager;

class TicketListener  extends GeneralManager implements EventSubscriber
{
	 protected  $mailer;

		public function getSubscribedEvents(){
			 return ['postPersist'];

   	 	}
    	public function postPersist(LifecycleEventArgs $args){

				$ticket = $args->getEntity();
				if (!$ticket instanceof Ticket) {
				return;
				}
				$entityManager = $args->getObjectManager();

        $data =json_decode(  $ticket->getParametro() );


        $title= "";
        $emailSend="";
        $params= [];
        $layaut="";

        if(  $ticket->getTipo() === Ticket::TIPO_ACTIVA_CUENTA_NIM  ){
            $title = "Confirmación de Cuenta Nim";
            $layaut = 'email/registro.twig.html';
    				$name= $data->nombre .' '.$data->apellidos ;
            $params=[
                "user" => [
                            "name" => $name,
                            "token"=> $ticket->getToken()
                ]
            ];
            $emailSend= $data->correo;
        }
				$message = (new \Swift_Message($title))
				 ->setFrom('masteraccount.nim@nimico.com')
				 ->setTo(  $emailSend  )
				 ->setBody($this->renderView($layaut,$params), 'text/html');
			 $this->mailer->send($message);

    	}


			/**
			* @required
			*/
			public function setMailer( \Swift_Mailer $mailer   ){
				$this->mailer= $mailer;
			}




}
?>
