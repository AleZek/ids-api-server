<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MappaRepository")
 * @ApiResource(itemOperations={
 *     "get",
 *     "put",
 *     "delete",
 *     },
 *     collectionOperations={
 *     "post",
 *     "get",
 *     "update_img"={"route_name"="api_update_image"},
 *     "delete_dati_mappa"={"route_name"="api_delete_map_data"},
 *     "post_map_image"={"route_name"="api_insert_image"},
 *     "retrieve_map_image"={"route_name"="api_get_image"},
 *     })
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
