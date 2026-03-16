<?php

namespace App\Entity;

use App\Repository\ProspectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ProspectRepository::class)]
#[ORM\Table(name: 'prospect')]
class Prospect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['prospect:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['prospect:read'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['prospect:read'])]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['prospect:read'])]
    private ?string $entreprise = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    #[Groups(['prospect:read'])]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['prospect:read'])]
    private ?string $email = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    #[Groups(['prospect:read'])]
    private ?string $potentiel = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Groups(['prospect:read'])]
    private ?string $notes = null;

    #[ORM\ManyToOne(inversedBy: 'prospect')]
    #[Groups(['prospect:read'])]
    private ?Statuts $statuts = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPotentiel(): ?string
    {
        return $this->potentiel;
    }

    public function setPotentiel(?string $potentiel): static
    {
        $this->potentiel = $potentiel;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getStatuts(): ?Statuts
    {
        return $this->statuts;
    }

    public function setStatuts(?Statuts $statuts): static
    {
        $this->statuts = $statuts;

        return $this;
    }
}
