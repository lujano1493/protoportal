<?php
namespace AppBundle\Listener;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\UsuarioCliente;
use AppBundle\Entity\Ticket;
use AppBundle\Service\GeneralManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Util\SerializeFactory;

class UserListener  extends GeneralManager implements EventSubscriber
{
	 protected  $passwordEncoder;
	 protected  $mailer;

		public function getSubscribedEvents(){
			 return ['prePersist','preUpdate','postPersist'];

   	 	}

   	 	public function prePersist(LifecycleEventArgs $args)
    	{
    		 $user = $args->getEntity();
	        if (!$user instanceof UsuarioCliente) {
	            return;
	        }

	      $password = $this->passwordEncoder->encodePassword($user, $user->getContrasena());
       	$user->setContrasena($password);
				$keycode = $this->generateKeySecurity( UsuarioCliente::class,'keyCode' , $user->getCorreo()     );
       	$user->setKeyCode ( $keycode );
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

			public function preUpdate(LifecycleEventArgs $args){
				$user = $args->getEntity();
				if (!$user instanceof UsuarioCliente) {
					return;
				}
				if( $user->getContrasena() != null ){
					$password = $this->passwordEncoder->encodePassword($user, $user->getContrasena());
					$user->setContrasena($password);
				}

		}

    	public function postPersist(LifecycleEventArgs $args){

				$user = $args->getEntity();
				if (!$user instanceof UsuarioCliente) {
				return;
				}
				//$serializer = SerializeFactory::create();
				$array=  $user->generarArray();
				$this->createToken(Ticket::TIPO_ACTIVA_CUENTA_NIM ,$user->getId() ,$array,$user->getCorreo());

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
