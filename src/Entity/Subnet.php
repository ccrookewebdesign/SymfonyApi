<?php

namespace App\Entity;

use App\Repository\SubnetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubnetRepository::class)
 */
class Subnet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subnet;

    /**
     * @ORM\Column(type="integer")
     */
    private $cidr;

    /**
     * @ORM\OneToMany(targetEntity=Ip::class, mappedBy="subnet", cascade={"all"}, fetch="EAGER" )
     */
    private $ips;

    public function __construct()
    {
        $this->ips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubnet(): ?string
    {
        return $this->subnet;
    }

    public function setSubnet(string $subnet): self
    {
        $this->subnet = $subnet;

        return $this;
    }

    public function getCidr(): ?int
    {
        return $this->cidr;
    }

    public function setCidr(int $cidr): self
    {
        $this->cidr = $cidr;

        return $this;
    }

    /**
     * @return Collection|Ip[]
     */
    public function getIps(): Collection
    {
        return $this->ips;
    }

    public function addIp(Ip $ip): self
    {
        if (!$this->ips->contains($ip)) {
            $this->ips[] = $ip;
            $ip->setSubnet($this);
        }

        return $this;
    }

    public function removeIp(Ip $ip): self
    {
        if ($this->ips->contains($ip)) {
            $this->ips->removeElement($ip);
            // set the owning side to null (unless already changed)
            if ($ip->getSubnet() === $this) {
                $ip->setSubnet(null);
            }
        }

        return $this;
    }
}
