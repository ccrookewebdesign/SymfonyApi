<?php

namespace App\Controller;

use App\Repository\SubnetRepository;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubnetController extends AbstractController {
  /**
   * @Route(path="/", methods={"GET"})
   */
  public function index(SubnetRepository $subnetRepository){ 
    return new JsonResponse(['subnets' => $subnetRepository->getSubnets()]);
  }  
}