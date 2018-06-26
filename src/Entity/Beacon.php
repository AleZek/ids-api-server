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
     * @ORM\Column(type="string")
     */
    private $type;
    /**
     * @ORM\Column(type="float",nullable=false,)
     */
    private $x;
    /**
     * @ORM\Column(type="float",nullable=false)
     */
    private $y;
    /**
     * @ORM\Column(type="float",nullable=false,)
     */
    private $meterx;
    /**
     * @ORM\Column(type="float",nullable=false)
     */
    private $metery;
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
     * @ORM\Column(type="float", nullable=false)
     *
     */
    private $width;
    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    private $device;

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
    public function getFloor()
    {
        return $this->floor;
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
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return mixed
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getMeterx()
    {
        return $this->meterx;
    }

    /**
     * @return mixed
     */
    public function getMetery()
    {
        return $this->metery;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $meterx
     */
    public function setMeterx($meterx)
    {
        $this->meterx = $meterx;
    }

    /**
     * @param mixed $metery
     */
    public function setMetery($metery)
    {
        $this->metery = $metery;
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
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * @param mixed $floor
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
    }

    /**
     * @param mixed $mappa
     */
    public function setMappa($mappa)
    {
        $this->mappa = $mappa;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @param mixed $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

}
