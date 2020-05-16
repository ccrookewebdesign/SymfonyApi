<?php

namespace App\Controller;

use App\Entity\Subnet;
use App\Entity\Ip;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubnetController extends AbstractController {
  /**
   * @Route("/")
   * @Method({"GET"})
   */
  public function index(){

     /* $subnet = new Subnet();
        $subnet->setSubnet('198.178.91.0');
        $subnet->setCidr(28);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($subnet);
        $entityManager->flush();
        
        $ip = new Ip();
        $ip->setIp('198.178.91.0');
        $ip->setAddressTag('<eq_03_xnbwb_4_mgmt_ip>');
        // relates this product to the subnet
        $ip->setSubnet($subnet);

        $ip2 = new Ip();
        $ip2->setIp('198.178.91.1');
        $ip2->setAddressTag('<opz_xd_5_primary_uplink_netwk_ip>');
        $ip2->setSubnet($subnet);

        $ip3 = new Ip();
        $ip3->setIp('198.178.91.2');
        $ip3->setAddressTag('<opz_xd_5_primary_uplink_broadcast_ip>');
        // relates this product to the subnet
        $ip3->setSubnet($subnet);

        
        $entityManager->persist($ip);
        $entityManager->persist($ip2);
        $entityManager->persist($ip3);
        $entityManager->flush();  */










    $subnets = $this->getDoctrine()->getRepository(Subnet::class)->findAll();
    

    $subnetsArray = [];

    foreach ($subnets as $subnet){
      //$ips = $this->getDoctrine()->getRepository(Ip::class)->findBy(['subnet_id' => $subnet->getId()]);
      $data = [
        'id' => (int) $subnet->getId(),
        'subnet' => (string) $subnet->getSubnet(),
        'cidr' => (int) $subnet->getCidr(),
         'ips' => $subnet->getIps()->toArray(),
        //'ips' => [],
      ];

      /* foreach ($ips as $ip){
        $newIp = ['ip' => $ip->getIp(), 'address_tag' => $ip->getAddressTag()];
        $data['ips'][] = $newIp;
      } */
      
      $subnetsArray[] = $data; 
    }

    /* foreach($subnetsArray[0]['ips'] as $ip){
      dump($ip);
    }
    die; */
    return new JsonResponse(['subnets' => $subnetsArray]);
  }
  
}