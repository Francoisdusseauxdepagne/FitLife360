<?php
namespace App\Repository;

use App\Entity\SessionCoaching;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SessionCoaching>
 *
 * @method SessionCoaching|null find($id, $lockMode = null, $lockVersion = null)
 * @method SessionCoaching|null findOneBy(array $criteria, array $orderBy = null)
 * @method SessionCoaching[]    findAll()
 * @method SessionCoaching[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionCoachingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SessionCoaching::class);
    }

    /**
     * Find coaching sessions by location.
     *
     * @param string $location
     * @return SessionCoaching[]
     */
    public function findByLocation(string $location): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.lieu LIKE :location')
            ->setParameter('location', '%'.$location.'%')
            ->getQuery()
            ->getResult();
    }
}
