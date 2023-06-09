<?php

namespace App\Entity;

use App\Repository\PosteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PosteRepository::class)]
class Poste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'Poste_id', targetEntity: User::class)]
    private Collection $poste;

    public function __construct()
    {
        $this->poste = new ArrayCollection();
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
     * @return Collection<int, user>
     */
    public function getPoste(): Collection
    {
        return $this->poste;
    }

    public function addPoste(User $poste): self
    {
        if (!$this->poste->contains($poste)) {
            $this->poste->add($poste);
            $poste->setposte($this);
        }

        return $this;
    }

    public function removePoste(User $poste): self
    {
        if ($this->poste->removeElement($poste)) {
            // set the owning side to null (unless already changed)
            if ($poste->getPoste() === $this) {
                $poste->setPoste(null);
            }
        }

        return $this;
    }
}
