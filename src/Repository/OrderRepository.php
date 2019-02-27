<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function countTicketsForDate(\DateTimeInterface $dateTime): int
    {
        //$this->find($ticket)->getNbrTickets();


        $nbr = $this->createQueryBuilder('t');

        $nbr->select($nbr->expr()->count('ticket.order'))
        ->where("order.date = $dateTime");

        try {
            return $nbr->getQuery()->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
        }

    }
}
