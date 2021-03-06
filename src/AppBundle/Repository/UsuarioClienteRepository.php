<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsuarioClienteRepository extends GeneralRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {

        return $this->createQueryBuilder('u')
            ->where('u.nickname = :username OR u.correo = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function anyHasKeyCode($keyCode    ){
      return   $this->hasAny(  [ "keyCode" => $keyCode   ])  ;

    }



}
