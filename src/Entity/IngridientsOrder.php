<?php

namespace App\Entity;

use App\Repository\IngridientsOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngridientsOrderRepository::class)
 */
class IngridientsOrder
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
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @ORM\ManyToMany(targetEntity=FoodIngridients::class, inversedBy="ingridientsOrders")
     */
    private $foodIngridients;

    public function __construct()
    {
        $this->foodIngridients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return Collection|FoodIngridients[]
     */
    public function getFoodIngridients(): Collection
    {
        return $this->foodIngridients;
    }

    public function addFoodIngridient(FoodIngridients $foodIngridient): self
    {
        if (!$this->foodIngridients->contains($foodIngridient)) {
            $this->foodIngridients[] = $foodIngridient;
        }

        return $this;
    }

    public function removeFoodIngridient(FoodIngridients $foodIngridient): self
    {
        $this->foodIngridients->removeElement($foodIngridient);

        return $this;
    }
}
