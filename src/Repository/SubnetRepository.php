<?php

namespace App\Repository;

use App\Entity\Subnet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method array getSubnets() return all subnets and child ips
 * @method Subnet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subnet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subnet[]    findAll()
 * @method Subnet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubnetRepository extends ServiceEntityRepository{
  public function __construct(ManagerRegistry $registry){
    parent::__construct($registry, Subnet::class);
  }

  /**
   * returns a 'json serialized' array of subnets and child ips
   */
  public function getSubnets(): array{
    $subnets = $this->findAll();
    $subnetsArray = [];

    foreach ($subnets as $subnet){
      $data = [
        'id' => (int) $subnet->getId(),
        'subnet' => (string) $subnet->getSubnet(),
        'cidr' => (int) $subnet->getCidr(),
        'ips' => [],
      ];

      foreach ($subnet->getIps() as $ip){
        $newIp = ['id' => $ip->getId(), 'subnet_id' => $ip->getSubnetId(), 'ip' => $ip->getIp(), 'address_tag' => $ip->getAddressTag()];
        $data['ips'][] = $newIp;
      }
    
      $subnetsArray[] = $data;
    }

    return $subnetsArray;
  }

  // /**
  //  * @return Subnet[] Returns an array of Subnet objects
  //  */
  /*
  public function findByExampleField($value){
      return $this->createQueryBuilder('s')
        ->andWhere('s.exampleField = :val')
        ->setParameter('val', $value)
        ->orderBy('s.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
  }
  */

  /*
  public function findOneBySomeField($value): ?Subnet{
    return $this->createQueryBuilder('s')
      ->andWhere('s.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult();
  }
  */
}
