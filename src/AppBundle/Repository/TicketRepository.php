<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends \Doctrine\ORM\EntityRepository
{
  public function loadTiketByToken($token)
  {

      return $this->createQueryBuilder('u')
          ->where('u.token= :token')
          ->setParameter('token', $token)
          ->getQuery()
          ->getOneOrNullResult();
  }


}
