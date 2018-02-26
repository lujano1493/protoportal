<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="usuario_cliente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioClienteRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity("correo", message="El correo ya ha sido utilizado")
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
     * @ORM\Column(name="fecha_registro", type="datetime")
     */
    private $fechaRegistro;



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
