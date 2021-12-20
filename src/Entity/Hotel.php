<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=HotelInfo::class, mappedBy="hotel", cascade={"persist", "remove"})
     */
    private HotelInfo $hotelInfo;

    /**
     * @ORM\ManyToMany(targetEntity=Reservation::class, mappedBy="hotel")
     */
    private $reservations;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="hotel")
     */
    private $employee;

    /**
     * @ORM\ManyToMany(targetEntity=FoodOrder::class, inversedBy="hotels")
     */
    private $foodOrder;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->foodOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotelInfo(): ?HotelInfo
    {
        return $this->hotelInfo;
    }

    public function setHotelInfo(?HotelInfo $hotelInfo): self
    {
        // unset the owning side of the relation if necessary
        if ($hotelInfo === null && $this->hotelInfo !== null) {
            $this->hotelInfo->setHotelId(null);
        }

        // set the owning side of the relation if necessary
        if ($hotelInfo !== null && $hotelInfo->getHotel() !== $this) {
            $hotelInfo->setHotel($this);
        }

        $this->hotelInfo = $hotelInfo;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->addHotel($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            $reservation->removeHotel($this);
        }

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function __toString()
    {
        return $this->id . ' ' . $this->hotelInfo->getCost() . ' ' . $this->hotelInfo->getNumberFloor() . ' ' . $this->hotelInfo->getNumberClass();
    }

    /**
     * @return Collection|FoodOrder[]
     */
    public function getFoodOrder(): Collection
    {
        return $this->foodOrder;
    }

    public function addFoodOrder(FoodOrder $foodOrder): self
    {
        if (!$this->foodOrder->contains($foodOrder)) {
            $this->foodOrder[] = $foodOrder;
        }

        return $this;
    }

    public function removeFoodOrder(FoodOrder $foodOrder): self
    {
        $this->foodOrder->removeElement($foodOrder);

        return $this;
    }


}
