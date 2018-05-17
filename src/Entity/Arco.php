<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 *
 * @ORM\Entity(repositoryClass="App\Repository\ArcoRepository")
 * @ApiResource(itemOperations={
 *     "get",
 *     "put",
 *     "delete",
 *     },
 *     collectionOperations={
 *     "get",
 *     "post",
 *
 *     }
 * )
 */
class Arco
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Beacon", inversedBy="id")
     * @ApiSubresource()
     */
    private $begin;
    /**
     * @ORM\ManyToOne(targetEntity="Beacon", inversedBy="id")
     * @ApiSubresource()
     */
    private $end;
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $length;
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $width;
    /**
     * @ORM\Column(type="boolean")
     *
     */
    private $stairs;
    /**
     * @ORM\Column(type="float")
     */
    private $v;
    /**
     * @ORM\Column(type="float")
     */
    private $i;
    /**
     * @ORM\Column(type="float")
     */
    private $c;
    /**
     * @ORM\Column(type="float")
     */
    private $los;

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
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
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
    public function getStairs()
    {
        return $this->stairs;
    }

    /**
     * @return mixed
     */
    public function getV()
    {
        return $this->v;
    }

    /**
     * @return mixed
     */
    public function getI()
    {
        return $this->i;
    }

    /**
     * @return mixed
     */
    public function getC()
    {
        return $this->c;
    }

    /**
     * @return mixed
     */
    public function getLos()
    {
        return $this->los;
    }

    /**
     * @param mixed $begin
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @param mixed $stairs
     */
    public function setStairs($stairs)
    {
        $this->stairs = $stairs;
    }

    /**
     * @param mixed $v
     */
    public function setV($v)
    {
        $this->v = $v;
    }

    /**
     * @param mixed $i
     */
    public function setI($i)
    {
        $this->i = $i;
    }

    /**
     * @param mixed $c
     */
    public function setC($c)
    {
        $this->c = $c;
    }

    /**
     * @param mixed $los
     */
    public function setLos($los)
    {
        $this->los = $los;
    }

}
