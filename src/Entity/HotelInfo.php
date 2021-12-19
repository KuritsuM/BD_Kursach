<?php

namespace App\Entity;

use App\Repository\HotelInfoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HotelInfoRepository::class)
 */
class HotelInfo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $cost;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number_class;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_floor;

    /**
     * @ORM\OneToOne(targetEntity=Hotel::class, inversedBy="hotelInfo", cascade={"persist", "remove"})
     */
    private $hotel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getNumberClass(): ?string
    {
        return $this->number_class;
    }

    public function setNumberClass(string $number_class): self
    {
        $this->number_class = $number_class;

        return $this;
    }

    public function getNumberFloor(): ?int
    {
        return $this->number_floor;
    }

    public function setNumberFloor(int $number_floor): self
    {
        $this->number_floor = $number_floor;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
