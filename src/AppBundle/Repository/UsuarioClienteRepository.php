<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsuarioClienteRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {

        return $this->createQueryBuilder('u')
            ->where('u.nickname = :username OR u.correo = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
