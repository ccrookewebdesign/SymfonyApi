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

    /* $publicDir = $this->getParameter('kernel.project_dir');

    $subnetsJson = json_decode(file_get_contents($publicDir . '\public\subnets.json'));

    foreach($subnetsJson as $subnetJson){
      $subnet = new Subnet();
      $subnet->setSubnet($subnetJson->subnet);
      $subnet->setCidr($subnetJson->cidr);
      
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($subnet);

      foreach($subnetJson->ips as $subnetJsonIp){
        $ip = new Ip();
        $ip->setIp($subnetJsonIp->ip);
        $ip->setAddressTag($subnetJsonIp->address_tag);
        $ip->setSubnet($subnet);

        $entityManager->persist($ip);        
      }
      
      $entityManager->flush();
    } */
    
    $subnets = $this->getDoctrine()->getRepository(Subnet::class)->findAll();
    
    // may not need to do all of this and instead just pass $subnets through
    $subnetsArray = [];

    foreach ($subnets as $subnet){
      $data = [
        'id' => (int) $subnet->getId(),
        'subnet' => (string) $subnet->getSubnet(),
        'cidr' => (int) $subnet->getCidr(),
        'ips' => $subnet->getIps()->toArray(),
      ];

      $subnetsArray[] = $data; 
    }

    return new JsonResponse(['subnets' => $subnetsArray]);
  }
  
}