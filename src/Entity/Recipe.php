<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrepTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $CookTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CookTool", inversedBy="recipes")
     */
    private $cookTool;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", inversedBy="recipes")
     */
    private $ingredients;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="recipes")
     */
    private $tags;

    public function __construct()
    {
        $this->cookTool = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
        $this->tags = new ArrayCollection();
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

    public function getPrepTime(): ?int
    {
        return $this->PrepTime;
    }

    public function setPrepTime(int $PrepTime): self
    {
        $this->PrepTime = $PrepTime;

        return $this;
    }

    public function getCookTime(): ?int
    {
        return $this->CookTime;
    }

    public function setCookTime(int $CookTime): self
    {
        $this->CookTime = $CookTime;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function __toString(){
        return $this->name;
    }

    /**
     * @return Collection|CookTool[]
     */
    public function getCookTool(): Collection
    {
        return $this->cookTool;
    }

    public function addCookTool(CookTool $cookTool): self
    {
        if (!$this->cookTool->contains($cookTool)) {
            $this->cookTool[] = $cookTool;
        }

        return $this;
    }

    public function removeCookTool(CookTool $cookTool): self
    {
        if ($this->cookTool->contains($cookTool)) {
            $this->cookTool->removeElement($cookTool);
        }

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }
}
