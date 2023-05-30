<?php

namespace App\Entity;

use App\Repository\CouleurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouleurRepository::class)]
class Couleur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'couleur', targetEntity: voiture::class)]
    private Collection $couleur;

    public function __construct()
    {
        $this->couleur = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, voiture>
     */
    public function getCouleur(): Collection
    {
        return $this->couleur;
    }

    public function addCouleur(voiture $couleur): self
    {
        if (!$this->couleur->contains($couleur)) {
            $this->couleur->add($couleur);
            $couleur->setCouleur($this);
        }

        return $this;
    }

    public function removeCouleur(voiture $couleur): self
    {
        if ($this->couleur->removeElement($couleur)) {
            // set the owning side to null (unless already changed)
            if ($couleur->getCouleur() === $this) {
                $couleur->setCouleur(null);
            }
        }

        return $this;
    }

}
