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
    private $xinizio;
    /**
     * @ORM\Column(type="float",nullable=false)
     */
    private $xfine;
    /**
     * @ORM\Column(type="float",nullable=false)
     */
    private $yinizio;
    /**
     * @ORM\Column(type="float",nullable=false)
     */
    private $yfine;

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
    public function getXinizio()
    {
        return $this->xinizio;
    }

    /**
     * @return mixed
     */
    public function getXfine()
    {
        return $this->xfine;
    }

    /**
     * @return mixed
     */
    public function getYinizio()
    {
        return $this->yinizio;
    }

    /**
     * @return mixed
     */
    public function getYfine()
    {
        return $this->yfine;
    }

    /**
     * @return mixed
     */
    public function getMappa()
    {
        return $this->mappa;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $xinizio
     */
    public function setXinizio($xinizio)
    {
        $this->xinizio = $xinizio;
    }

    /**
     * @param mixed $xfine
     */
    public function setXfine($xfine)
    {
        $this->xfine = $xfine;
    }

    /**
     * @param mixed $yinizio
     */
    public function setYinizio($yinizio)
    {
        $this->yinizio = $yinizio;
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


}
