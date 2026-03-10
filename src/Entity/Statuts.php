<?php

namespace App\Entity;

use App\Repository\StatutsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutsRepository::class)]
class Statuts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $principal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondary = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrincipal(): ?string
    {
        return $this->principal;
    }

    public function setPrincipal(string $principal): static
    {
        $this->principal = $principal;

        return $this;
    }

    public function getSecondary(): ?string
    {
        return $this->secondary;
    }

    public function setSecondary(?string $secondary): static
    {
        $this->secondary = $secondary;

        return $this;
    }
}
