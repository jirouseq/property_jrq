<?php

namespace App\Entity;

use App\Repository\AttributesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributesRepository::class)]
class Attributes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Property::class, mappedBy: 'attributes')]
    private Collection $properties;

    #[ORM\OneToMany(targetEntity: AttributeEnable::class, mappedBy: 'attributes')]
    private Collection $attributeEnables;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->attributeEnables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Property>
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): static
    {
        if (!$this->properties->contains($property)) {
            $this->properties->add($property);
            $property->setAttributes($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): static
    {
        if ($this->properties->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getAttributes() === $this) {
                $property->setAttributes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AttributeEnable>
     */
    public function getAttributeEnables(): Collection
    {
        return $this->attributeEnables;
    }

    public function addAttributeEnable(AttributeEnable $attributeEnable): static
    {
        if (!$this->attributeEnables->contains($attributeEnable)) {
            $this->attributeEnables->add($attributeEnable);
            $attributeEnable->setAttributes($this);
        }

        return $this;
    }

    public function removeAttributeEnable(AttributeEnable $attributeEnable): static
    {
        if ($this->attributeEnables->removeElement($attributeEnable)) {
            // set the owning side to null (unless already changed)
            if ($attributeEnable->getAttributes() === $this) {
                $attributeEnable->setAttributes(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
