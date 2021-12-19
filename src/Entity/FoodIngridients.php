<?php

namespace App\Entity;

use App\Repository\FoodIngridientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodIngridientsRepository::class)
 */
class FoodIngridients
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
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @ORM\ManyToMany(targetEntity=Food::class, inversedBy="foodIngridients")
     */
    private $food;

    /**
     * @ORM\ManyToMany(targetEntity=IngridientsOrder::class, mappedBy="foodIngridients")
     */
    private $ingridientsOrders;

    public function __construct()
    {
        $this->food = new ArrayCollection();
        $this->ingridientsOrders = new ArrayCollection();
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
     * @return Collection|Food[]
     */
    public function getFood(): Collection
    {
        return $this->food;
    }

    public function addFood(Food $food): self
    {
        if (!$this->food->contains($food)) {
            $this->food[] = $food;
        }

        return $this;
    }

    public function removeFood(Food $food): self
    {
        $this->food->removeElement($food);

        return $this;
    }

    /**
     * @return Collection|IngridientsOrder[]
     */
    public function getIngridientsOrders(): Collection
    {
        return $this->ingridientsOrders;
    }

    public function addIngridientsOrder(IngridientsOrder $ingridientsOrder): self
    {
        if (!$this->ingridientsOrders->contains($ingridientsOrder)) {
            $this->ingridientsOrders[] = $ingridientsOrder;
            $ingridientsOrder->addFoodIngridient($this);
        }

        return $this;
    }

    public function removeIngridientsOrder(IngridientsOrder $ingridientsOrder): self
    {
        if ($this->ingridientsOrders->removeElement($ingridientsOrder)) {
            $ingridientsOrder->removeFoodIngridient($this);
        }

        return $this;
    }
}
