<?php

namespace App\DataFixtures;

use App\Entity\Subnet;
use App\Entity\Ip;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

class SubnetFixtures extends Fixture
{
  private $appKernel;

  public function __construct(KernelInterface $appKernel){
    $this->appKernel = $appKernel;
  }

    public function load(ObjectManager $manager)
    {
      //$publicDir = $this->getParameter('kernel.project_dir');
      $publicDir = $this->appKernel->getProjectDir();

      $subnetsJson = json_decode(file_get_contents($publicDir . '\public\subnets.json'));
  
      foreach($subnetsJson as $subnetJson){
        $subnet = new Subnet();
        $subnet->setSubnet($subnetJson->subnet);
        $subnet->setCidr($subnetJson->cidr);
        
        $manager->persist($subnet);
  
        foreach($subnetJson->ips as $subnetJsonIp){
          $ip = new Ip();
          $ip->setIp($subnetJsonIp->ip);
          $ip->setAddressTag($subnetJsonIp->address_tag);
          $ip->setSubnet($subnet);
  
          $manager->persist($ip);        
        }
        
        $manager->flush();
      }

        // $manager->flush();
    }
}
