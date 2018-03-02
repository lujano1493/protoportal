<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="usuario_cliente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioClienteRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity("correo", message="El correo ya ha sido utilizado")
 * @UniqueEntity("nickname", message="El nickname ya ha sido utilizado")
 */
class UsuarioCliente implements AdvancedUserInterface, \Serializable
{
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
     *
     * @ORM\Column(name="nombre", type="string", length=128, nullable=true)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Tu nombre no puede contener numeros"
     * )
     */
    private $nombre;



    /**
     * @var string
     *
     * @ORM\Column(name="apellido_paterno", type="string", length=128)
     */
    private $paterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_materno", type="string", length=128, nullable=true)
     */
    private $materno;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=256, unique=true)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="contrasena", type="string", length=512)
     */
    private $contrasena;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=100, nullable=true, unique=true)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=12, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="monto_inicial", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $montoInicial;


    /**
     * @var string
     *
     * @ORM\Column(name="pais_codigo", type="string", length=2, nullable=true)
     */
    private $paisCodigo;



   /**
     * @var \DateTime
     *
     * @Assert\Date(message="Ingresa fecha valida")
     * @ORM\Column(name="fecha_nacimiento", type="datetime")
     */
    private $fechaNac;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime")
     */
    private $fechaRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="keycode", type="string", length=521, nullable=true)
     */
    private $keyCode;


    /**
     * @var int
     *
     * @ORM\Column(name="estatus", type="integer")
     */
    private $estatus;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return User
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }



    /**
     * Set paterno
     *
     * @param string $paterno
     *
     * @return User
     */
    public function setPaterno($paterno)
    {
        $this->paterno = $paterno;

        return $this;
    }

    /**
     * Get paterno
     *
     * @return string
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Set materno
     *
     * @param string $materno
     *
     * @return User
     */
    public function setMaterno($materno)
    {
        $this->materno = $materno;

        return $this;
    }

    /**
     * Get materno
     *
     * @return string
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return User
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set contrasena
     *
     * @param string $contrasena
     *
     * @return User
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    /**
     * Get contrasena
     *
     * @return string
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return User
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set montoInicial
     *
     * @param string $montoInicial
     *
     * @return User
     */
    public function setMontoInicial($montoInicial)
    {
        $this->montoInicial = $montoInicial;

        return $this;
    }

    /**
     * Get montoInicial
     *
     * @return string
     */
    public function getMontoInicial()
    {
        return $this->montoInicial;
    }



    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return User
     */
    public function setPaisCodigo($paisCodigo)
    {
        $this->paisCodigo = $paisCodigo;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPaisCodigo()
    {
        return $this->paisCodigo;
    }


        /**
         * Get the value of Fecha Nac
         *
         * @return \DateTime
         */
        public function getFechaNac()
        {
            return $this->fechaNac;
        }

        /**
         * Set the value of Fecha Nac
         *
         * @param \DateTime fechaNac
         *
         * @return self
         */
        public function setFechaNac(\DateTime $fechaNac)
        {
            $this->fechaNac = $fechaNac;

            return $this;
        }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return User
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }


   /**
     * @ORM\PrePersist
     */
    public function setCreaFechaRegistro()
    {
        $this->fechaRegistro = new \DateTime();
    }



        /**
         * Get the value of Key Code
         *
         * @return string
         */
        public function getKeyCode()
        {
            return $this->keyCode;
        }

        /**
         * Set the value of Key Code
         *
         * @param string keyCode
         *
         * @return self
         */
        public function setKeyCode($keyCode)
        {
            $this->keyCode = $keyCode;

            return $this;
        }

        /**
         * Get the value of Estatus
         *
         * @return int
         */
        public function getEstatus()
        {
            return $this->estatus;
        }

        /**
         * Set the value of Estatus
         *
         * @param int estatus
         *
         * @return self
         */
        public function setEstatus($estatus)
        {
            $this->estatus = $estatus;

            return $this;
        }

    /**
     * @ORM\PrePersist
     */
    public function generaKeyCode()
    {
            $opciones = [
                'cost' => 11,
                'salt' => random_bytes(22),
            ];
            $this->keyCode=password_hash($this->contrasena, CRYPT_BLOWFISH, $opciones);
            $this->estatus=0;
    }

      public function getSalt()
    {
        return null;
    }

     public function getRoles(){
        return ["ROLE_USER_NIM"];
     }


    public function getPassword(){
        return $this->contrasena;
    }

      public function getUsername(){
        return $this->correo;
      }

    public function eraseCredentials(){

    }

    public function isAccountNonExpired(){
      return true;
    }

    public function isAccountNonLocked(){
      return true;
    }
    public function isCredentialsNonExpired(){
      return true;
    }
    public function isEnabled(){
      return $this->estatus ===1;
    }



      /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->correo,
            $this->contrasena,
            $this->estatus
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->correo,
            $this->contrasena,
            $this->estatus
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }










}
