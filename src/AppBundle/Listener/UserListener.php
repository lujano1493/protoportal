<?php 
namespace AppBundle\Listener;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\UsuarioCliente;
use AppBundle\Entity\Ticket;

class UserListener implements EventSubscriber
{
	 protected  $passwordEncoder;

		public function getSubscribedEvents(){
			 return ['prePersist','PostPersist'];

   	 	}

   	 	public function prePersist(LifecycleEventArgs $args)
    	{
    		 $user = $args->getEntity();
	        if (!$user instanceof UsuarioCliente) {
	            return;
	        }

	        $password = $this->passwordEncoder->encodePassword($user, $user->getContrasena());
       		$user->setContrasena($password);

       		$user->keyCode= hash("sha512",random_bytes(5) . $user->getContrasena() . $user->getCorreo()   );
			$user->estatus=0;

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

    	public function PostPersist(LifecycleEventArgs $args){

			$user = $args->getEntity();
			if (!$user instanceof UsuarioCliente) {
			return;
			}
			$entityManager = $args->getObjectManager();
			$ticket = new Ticket();
			$ticket->setTipo("active_user_nim_token");
			$ticket->setParametro($user->getKeyCode());
			$ticket->setToken(hash("sha512",random_bytes(5). $this->getCorreo() .$this->getContrasena() ) );
			$entityManager->persist( $ticket  );
			$entityManager->flush();	           	

    	}

}
?>