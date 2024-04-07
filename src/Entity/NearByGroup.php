<?php

namespace App\Entity;

use App\Repository\NearByGroupRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NearByGroupRepository::class)]
class NearByGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'nearByGroups')]
    private ?Property $property = null;

    #[ORM\ManyToOne(inversedBy: 'nearByGroups')]
    private ?NearBy $nearBy = null;

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

    public function getNearBy(): ?NearBy
    {
        return $this->nearBy;
    }

    public function setNearBy(?NearBy $nearBy): static
    {
        $this->nearBy = $nearBy;

        return $this;
    }

    public function __toString()
    {
        return $this->nearBy ? $this->nearBy->getName() : '';
    }
}
