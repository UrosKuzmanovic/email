<?php

namespace App\Repository;

use App\Entity\EmailSent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmailSent>
 *
 * @method EmailSent|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmailSent|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmailSent[]    findAll()
 * @method EmailSent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailSentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailSent::class);
    }

    /**
     * @param EmailSent $emailSent
     * @return EmailSent
     */
    public function add(EmailSent $emailSent): EmailSent
    {
        try {
            $this->getEntityManager()->persist($emailSent);
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            return new EmailSent();
        }

        return $emailSent;
    }

    /**
     * @param EmailSent $entity
     * @return void
     */
    public function remove(EmailSent $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
