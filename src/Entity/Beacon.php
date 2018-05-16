<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeaconRepository")
 * @ApiResource()
 */
class Beacon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="float",nullable=false,)
     */
    private $x;
    /**
     * @ORM\Column(type="float",nullable=false)
     */
    private $y;
    /**
     * @ORM\Column(type="integer",nullable=false)
     */
    private $floor;
    /**
     * @ORM\ManyToOne(targetEntity="Mappa", inversedBy="beacons")
     * @ApiSubresource()
     */
    private $mappa;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return mixed
     */
    public function getMappa()
    {
        return $this->mappa;
    }

    /**
     * @return mixed
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @param mixed $xfine
     */
    public function setXfine($xfine)
    {
        $this->xfine = $xfine;
    }

    /**
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * @param mixed $yfine
     */
    public function setYfine($yfine)
    {
        $this->yfine = $yfine;
    }

    /**
     * @param mixed $mappa
     */
    public function setMappa($mappa)
    {
        $this->mappa = $mappa;
    }

    /**
     * @param mixed $floor
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
    }


}
