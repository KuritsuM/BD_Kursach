<?php

namespace App\Entity;

use App\Repository\EmployeeInfoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeInfoRepository::class)
 */
class EmployeeInfo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $hiring_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $firing_date;

    /**
     * @ORM\Column(type="float")
     */
    private $salary;

    /**
     * @ORM\OneToOne(targetEntity=Employee::class, inversedBy="employeeInfo", cascade={"persist", "remove"})
     */
    private $employee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHiringDate(): ?\DateTimeInterface
    {
        return $this->hiring_date;
    }

    public function setHiringDate(\DateTimeInterface $hiring_date): self
    {
        $this->hiring_date = $hiring_date;

        return $this;
    }

    public function getFiringDate(): ?\DateTimeInterface
    {
        return $this->firing_date;
    }

    public function setFiringDate(?\DateTimeInterface $firing_date): self
    {
        $this->firing_date = $firing_date;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): self
    {
        $this->salary = $salary;

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
