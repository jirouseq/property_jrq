<?php

namespace App\Entity;

use App\Repository\NearByRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NearByRepository::class)]
class NearBy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Property::class, mappedBy: 'nearBy')]
    private Collection $properties;

    #[ORM\OneToMany(targetEntity: NearByGroup::class, mappedBy: 'nearBy')]
    private Collection $nearByGroups;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->nearByGroups = new ArrayCollection();
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
            $property->setNearBy($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): static
    {
        if ($this->properties->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getNearBy() === $this) {
                $property->setNearBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NearByGroup>
     */
    public function getNearByGroups(): Collection
    {
        return $this->nearByGroups;
    }

    public function addNearByGroup(NearByGroup $nearByGroup): static
    {
        if (!$this->nearByGroups->contains($nearByGroup)) {
            $this->nearByGroups->add($nearByGroup);
            $nearByGroup->setNearBy($this);
        }

        return $this;
    }

    public function removeNearByGroup(NearByGroup $nearByGroup): static
    {
        if ($this->nearByGroups->removeElement($nearByGroup)) {
            // set the owning side to null (unless already changed)
            if ($nearByGroup->getNearBy() === $this) {
                $nearByGroup->setNearBy(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
