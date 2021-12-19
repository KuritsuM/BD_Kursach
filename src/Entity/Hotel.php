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
     * @ORM\OneToOne(targetEntity=HotelInfo::class, mappedBy="hotel_id", cascade={"persist", "remove"})
     */
    private $hotelInfo;

    /**
     * @ORM\ManyToMany(targetEntity=Reservation::class, mappedBy="hotel")
     */
    private $reservations;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="hotel")
     */
    private $employee;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
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
}
