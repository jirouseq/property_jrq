<?php

namespace App\Entity;

use App\Repository\AttributeEnableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributeEnableRepository::class)]
class AttributeEnable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'attributeEnables')]
    private ?Property $property = null;

    #[ORM\ManyToOne(inversedBy: 'attributeEnables')]
    private ?Attributes $attributes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): static
    {
        $this->property = $property;

        return $this;
    }

    public function getAttributes(): ?Attributes
    {
        return $this->attributes;
    }

    public function setAttributes(?Attributes $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function __toString()
    {
        return $this->attributes ? $this->attributes->getName() : '';
    }
}
