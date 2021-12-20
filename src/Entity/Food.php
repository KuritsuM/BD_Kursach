<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodRepository::class)
 */
class Food
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
     * @ORM\Column(type="float")
     */
    private $cost;

    /**
     * @ORM\ManyToMany(targetEntity=FoodOrder::class, inversedBy="food")
     */
    private $food_order;

    /**
     * @ORM\ManyToMany(targetEntity=FoodIngridients::class, mappedBy="food")
     */
    private $foodIngridients;

    public function __construct()
    {
        $this->food_order = new ArrayCollection();
        $this->foodIngridients = new ArrayCollection();
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

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return Collection|FoodOrder[]
     */
    public function getFoodOrder(): Collection
    {
        return $this->food_order;
    }

    public function addFoodOrder(FoodOrder $foodOrder): self
    {
        if (!$this->food_order->contains($foodOrder)) {
            $this->food_order[] = $foodOrder;
        }

        return $this;
    }

    public function removeFoodOrder(FoodOrder $foodOrder): self
    {
        $this->food_order->removeElement($foodOrder);

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
            $foodIngridient->addFood($this);
        }

        return $this;
    }

    public function removeFoodIngridient(FoodIngridients $foodIngridient): self
    {
        if ($this->foodIngridients->removeElement($foodIngridient)) {
            $foodIngridient->removeFood($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }


}
