<?php

namespace App\Entity;

use App\Repository\CaracteristiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaracteristiqueRepository::class)]
class Caracteristique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $boite_vitesse_manuelle = null;

    #[ORM\Column]
    private ?bool $nb_portes_5 = null;

    #[ORM\Column]
    private ?int $puissance_fisc = null;

    #[ORM\Column]
    private ?float $puissance_din = null;

    #[ORM\Column(length: 50)]
    private ?string $co2 = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function isBoiteVitesseManuelle(): ?bool
    {
        return $this->boite_vitesse_manuelle;
    }

    public function setBoiteVitesseManuelle(bool $boite_vitesse_manuelle): self
    {
        $this->boite_vitesse_manuelle = $boite_vitesse_manuelle;

        return $this;
    }

    public function isNbPortes5(): ?bool
    {
        return $this->nb_portes_5;
    }

    public function setNbPortes5(bool $nb_portes_5): self
    {
        $this->nb_portes_5 = $nb_portes_5;

        return $this;
    }

    public function getPuissanceFisc(): ?int
    {
        return $this->puissance_fisc;
    }

    public function setPuissanceFisc(int $puissance_fisc): self
    {
        $this->puissance_fisc = $puissance_fisc;

        return $this;
    }

    public function getPuissanceDin(): ?float
    {
        return $this->puissance_din;
    }

    public function setPuissanceDin(float $puissance_din): self
    {
        $this->puissance_din = $puissance_din;

        return $this;
    }

    public function getCo2(): ?string
    {
        return $this->co2;
    }

    public function setCo2(string $co2): self
    {
        $this->co2 = $co2;

        return $this;
    }

}
