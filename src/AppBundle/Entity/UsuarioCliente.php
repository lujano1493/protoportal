<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="UsuarioCliente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class UsuarioCliente
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
     */
    private $nombre;

    /**
    * @var string
    *
    */
    private $apellidos;

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
     * @ORM\Column(name="codigo_postal", type="string", length=12)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=100, nullable=true)
     */
    private $pais;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime")
     */
    private $fechaRegistro;


    private $checarTerminos;

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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return User
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
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
     * Set cp
     *
     * @param string $cp
     *
     * @return User
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return User
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
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



    public function  hasChecarTerminos(){
      return $this->checarTerminos;
    }

    public function setChecarTerminos($checarTerminos){
      $this->checarTerminos=$checarTerminos;
      return $this;
    }


   /**
     * @ORM\PrePersist
     */
    public function setCreaFechaRegistro()
    {
        $this->fechaRegistro = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function encriptarContrasena()
    {
            // PHP has had a built-in password_hash function since 5.5.0
            // It's currently based on BCRYPT, but pass PASSWORD_BCRYPT
            // to ensure this doesn't change.

            // Generate a password using a random salt
            $this->contrasena= password_hash($this->contrasena, PASSWORD_BCRYPT);

            // Generate a password with a known salt.
            //password_hash($password, PASSWORD_BCRYPT, array("salt" => $salt));


            // Before 5.5:
            // 5.3.7 and on: use $2y$ as the salt prefix
            // Otherwise, use $2x$
            // This will cause crypt to generate a bcrypt hash
            //$salt = '$2y$10$' . mcrypt_create_iv(22);
           // $salted_password = crypt($password, $salt)

            // Both algorithms generate a 60-character string that looks like:
// $salt . $hashed_password

    }

}
