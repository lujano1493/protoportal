<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TicketRepository")
 * @UniqueEntity("token", message="El token ya ha sido utilizado")
 */
class Ticket
{

    const TIPO_ACTIVA_CUENTA_NIM ="active_user_nim_token";
    const TIPO_REENVIO_CUENTA_NIM ="send_user_nim";
    const TIPO_REESTABLECER_CONTRASENA_NIM = "restablece_pass_nim";
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @var string
    * @ORM\Column(name="tipo",type="string", length=100)
    */
   private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime")
     */
    private $fechaRegistro;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_expiracion", type="datetime")
     */
    private $fechaExpiracion;



    /**
    * @var string
    * @ORM\Column(name="token",type="string", length=512, unique=true)
    */
   private $token;


   /**
   * @var int
   * @ORM\Column(name="id_entidad",type="integer")
   */
   private $idEntidad;


   /**
   * @var string
   * @ORM\Column(name="parametro",type="string", length=1024)
   */
  private $parametro;






    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param int id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of Tipo
     *
     * @param string tipo
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of Fecha Registro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set the value of Fecha Registro
     *
     * @param \DateTime fechaRegistro
     *
     * @return self
     */
    public function setFechaRegistro(\DateTime $fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get the value of Token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of Token
     *
     * @param string token
     *
     * @return self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of Id Entidad
     *
     * @return int
     */
    public function getIdEntidad()
    {
        return $this->idEntidad;
    }

    /**
     * Set the value of Id Entidad
     *
     * @param int idEntidad
     *
     * @return self
     */
    public function setIdEntidad($idEntidad)
    {
        $this->idEntidad = $idEntidad;

        return $this;
    }


    /**
     * Get the value of Parametro
     *
     * @return string
     */
    public function getParametro()
    {
        return $this->parametro;
    }

    /**
     * Set the value of Parametro
     *
     * @param string parametro
     *
     * @return self
     */
    public function setParametro($parametro)
    {
        $this->parametro = $parametro;

        return $this;
    }

    /**
     * Get the value of Fecha Expiracion
     *
     * @return \DateTime
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }

    /**
     * Set the value of Fecha Expiracion
     *
     * @param \DateTime fechaExpiracion
     *
     * @return self
     */
    public function setFechaExpiracion(\DateTime $fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;
        return $this;
    }

    public function getExpirationDate($days = 1) {
        $expired  = new \DateTime();
        $expired->add(new \DateInterval('P'.$days.'D'));
        return $expired;
    }


    /**
     * @ORM\PrePersist
     */
     public function agregarFechasRegistroExpiracion(){
       $this->fechaRegistro= new \DateTime();
       $this->fechaExpiracion= $this->getExpirationDate();
     }






}



?>
