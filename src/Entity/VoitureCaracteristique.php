<?php

namespace App\Entity;

use App\Repository\VoitureCaracteristiqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureCaracteristiqueRepository::class)]
class VoitureCaracteristique
{
    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voiture $voiture = null;
    
    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Caracteristique $caracteristique = null;

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getCaracteristique(): ?caracteristique
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(?caracteristique $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }
}
