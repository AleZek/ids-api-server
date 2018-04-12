<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MappaRepository")
 * @ApiResource()
 */
class Mappa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=100, nullable=true)
     */
    private $image;


    /**
     * @ORM\OneToMany(targetEntity="Beacon", mappedBy="mappa")
     * @ApiSubresource()
     */
    private $beacons;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getImage() : ?string
    {
        return $this->image;
    }



    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBeacons()
    {
        return $this->beacons;
    }

    /**
     * @param mixed $beacons
     */
    public function setBeacons($beacons)
    {
        $this->beacons = $beacons;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }




}
