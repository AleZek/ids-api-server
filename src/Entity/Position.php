<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PositionRepository")
 * @ApiResource()
 */
class Position
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @ORM\OneToOne(targetEntity="User", inversedBy="email")
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="Beacon", inversedBy="id")
     */
    private $beacon;

    public function getId()
    {
        return $this->id;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBeacon(): ?int
    {
        return $this->beacon;
    }

    public function setBeacon(?int $beacon): self
    {
        $this->beacon = $beacon;

        return $this;
    }
}
