<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SubnetControllerTest extends WebTestCase{
  public function testShowPost(){
    $client = static::createClient();

    $client->request('GET', '/');

    $this->assertEquals(200, $client->getResponse()->getStatusCode());
    $this->assertJson($client->getResponse()->getContent());
  }
}