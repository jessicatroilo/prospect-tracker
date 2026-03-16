<?php

namespace App\Entity;

use App\Repository\StatutsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM; 
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: StatutsRepository::class)]
class Statuts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['prospect:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['prospect:read'])]
    private ?string $principal = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['prospect:read'])]
    private ?string $secondary = null;

    /**
     * @var Collection<int, Prospect>
     */
    #[ORM\OneToMany(targetEntity: Prospect::class, mappedBy: 'statuts')]
    private Collection $prospect;

    public function __construct()
    {
        $this->prospect = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Prospect>
     */
    public function getProspect(): Collection
    {
        return $this->prospect;
    }

    public function addProspect(Prospect $prospect): static
    {
        if (!$this->prospect->contains($prospect)) {
            $this->prospect->add($prospect);
            $prospect->setStatuts($this);
        }

        return $this;
    }

    public function removeProspect(Prospect $prospect): static
    {
        if ($this->prospect->removeElement($prospect)) {
            // set the owning side to null (unless already changed)
            if ($prospect->getStatuts() === $this) {
                $prospect->setStatuts(null);
            }
        }

        return $this;
    }
}
