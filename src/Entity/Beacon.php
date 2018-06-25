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
    private $meter_x;
    /**
     * @ORM\Column(type="float",nullable=false)
     */
    private $meter_y;
    /**
     * @ORM\Column(type="integer",nullable=false)
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
    public function getMeterX()
    {
        return $this->meter_x;
    }

    /**
     * @return mixed
     */
    public function getMeterY()
    {
        return $this->meter_y;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $meter_x
     */
    public function setMeterX($meter_x)
    {
        $this->meter_x = $meter_x;
    }

    /**
     * @param mixed $meter_y
     */
    public function setMeterY($meter_y)
    {
        $this->meter_y = $meter_y;
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
