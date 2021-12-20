<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Hotel::class, mappedBy="employee")
     */
    private $hotel;

    /**
     * @ORM\OneToOne(targetEntity=EmployeeInfo::class, mappedBy="employee", cascade={"persist", "remove"})
     */
    private $employeeInfo;

    /**
     * @ORM\ManyToMany(targetEntity=Position::class, mappedBy="employees")
     */
    private $positions;

    public function __construct()
    {
        $this->hotel = new ArrayCollection();
        $this->positions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Hotel[]
     */
    public function getHotel(): Collection
    {
        return $this->hotel;
    }

    public function addHotel(Hotel $hotel): self
    {
        if (!$this->hotel->contains($hotel)) {
            $this->hotel[] = $hotel;
            $hotel->setEmployee($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): self
    {
        if ($this->hotel->removeElement($hotel)) {
            // set the owning side to null (unless already changed)
            if ($hotel->getEmployee() === $this) {
                $hotel->setEmployee(null);
            }
        }

        return $this;
    }

    public function getEmployeeInfo(): ?EmployeeInfo
    {
        return $this->employeeInfo;
    }

    public function setEmployeeInfo(?EmployeeInfo $employeeInfo): self
    {
        // unset the owning side of the relation if necessary
        if ($employeeInfo === null && $this->employeeInfo !== null) {
            $this->employeeInfo->setEmployee(null);
        }

        // set the owning side of the relation if necessary
        if ($employeeInfo !== null && $employeeInfo->getEmployee() !== $this) {
            $employeeInfo->setEmployee($this);
        }

        $this->employeeInfo = $employeeInfo;

        return $this;
    }

    /**
     * @return Collection|Position[]
     */
    public function getPositions(): Collection
    {
        return $this->positions;
    }

    public function addPosition(Position $position): self
    {
        if (!$this->positions->contains($position)) {
            $this->positions[] = $position;
        }

        return $this;
    }

    public function removePosition(Position $position): self
    {
        if ($this->positions->removeElement($position)) {
            $position->removeEmployee($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }


}
