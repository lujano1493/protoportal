<?php
namespace AppBundle\Listener;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\UsuarioCliente;
use AppBundle\Entity\Ticket;
use AppBundle\Service\GeneralManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserListener  extends GeneralManager implements EventSubscriber
{
	 protected  $passwordEncoder;
	 protected  $mailer;

		public function getSubscribedEvents(){
			 return ['prePersist','postPersist'];

   	 	}

   	 	public function prePersist(LifecycleEventArgs $args)
    	{
    		 $user = $args->getEntity();
	        if (!$user instanceof UsuarioCliente) {
	            return;
	        }

	      $password = $this->passwordEncoder->encodePassword($user, $user->getContrasena());
       	$user->setContrasena($password);

       	$user->setKeyCode (hash("sha512",random_bytes(5)  . $user->getCorreo()   ) );
				$user->setEstatus(0);

       	$apellidos =  $user->getApellidos();
				$lista =preg_split("/[\s,]+/",  $apellidos );
				$user->setPaterno($lista[0]);
				$size=count($lista);
				if($size > 1 ){
					$otherLastName= "";
					for( $index=1;$index< $size ; $index++  ) {
					$otherLastName=  $otherLastName . ' '. $lista[$index];
					}
					$user->setMaterno($otherLastName);
				}

    	}

    	public function postPersist(LifecycleEventArgs $args){

				$user = $args->getEntity();
				if (!$user instanceof UsuarioCliente) {
				return;
				}
				$entityManager = $args->getObjectManager();
				$ticket = new Ticket();
				$ticket->setTipo("active_user_nim_token");
				$ticket->setParametro($user->getKeyCode());
				$ticket->setToken(hash("sha512",random_bytes(5) . $user->getCorreo() ) );
				$entityManager->persist( $ticket  );
				$entityManager->flush();

				$name= $user->getNombre() .' '.$user->getApellidos()  ;

				$message = (new \Swift_Message('Bienvenido'))
				 ->setFrom('webmasternim4@gmail.com')
				 ->setTo(  $user->getCorreo()  )
				 ->setBody(
						 $this->renderView(
								 'email/registro.twig.html',
								 compact("name")
						 ),
						 'text/html'
				 ); 
			 $this->mailer->send($message);

    	}

			/**
			* @required
			*/
			public function setPasswordEncoder(UserPasswordEncoderInterface $passwordEncoder){
				$this->passwordEncoder= $passwordEncoder;
			}

			/**
			* @required
			*/
			public function setMailer( \Swift_Mailer $mailer   ){
				$this->mailer= $mailer;
			}



}
?>
