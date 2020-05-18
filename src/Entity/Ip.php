<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IpRepository::class)
 */
class Ip{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\ManyToOne(targetEntity=Subnet::class, inversedBy="ips")
   * @ORM\JoinColumn(nullable=false)
   */
  private $subnet;
  
  /**
   * @ORM\Column(type="string", length=255, unique=true)
   */
  private $ip;

  /**
   * @ORM\Column(type="string", length=255, unique=true)
   */
  private $address_tag;

  /**
   * @ORM\Column(type="integer")
   */
  private $subnet_id;

  public function getId(): ?int{
    return $this->id;
  }

  public function getSubnet(): ?Subnet{
    return $this->subnet;
  }

  public function setSubnet(?Subnet $subnet): self{
    $this->subnet = $subnet;

    return $this;
  }

  public function getSubnetId(): ?int{
    return $this->subnet_id;
  }
  
  public function getIp(): ?string{
    return $this->ip;
  }

  public function setIp(string $ip): self{
    $this->ip = $ip;

    return $this;
  }

  public function getAddressTag(): ?string{
    return $this->address_tag;
  }

  public function setAddressTag(string $address_tag): self{
    $this->address_tag = $address_tag;

    return $this;
  }
}
