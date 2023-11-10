<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }


    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private $photo = null;

    #[ORM\Column]
    private ?bool $ctOk = null;

    #[ORM\Column]
    private ?int $kilometrage = null;

    #[ORM\Column]
    private ?bool $boiteVitesseManuelle = null;

    #[ORM\Column]
    private ?bool $nombreDePortes5 = null;

    #[ORM\Column]
    private ?int $puissanceFiscale = null;

    #[ORM\Column]
    private ?int $emissionCO2 = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function isCtOk(): ?bool
    {
        return $this->ctOk;
    }

    public function setCtOk(?bool $ctOk): self
    {
        $this->ctOk = $ctOk;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function isBoiteVitesseManuelle(): ?bool
    {
        return $this->boiteVitesseManuelle;
    }

    public function setBoiteVitesseManuelle(?bool $boiteVitesseManuelle): self
    {
        $this->boiteVitesseManuelle = $boiteVitesseManuelle;

        return $this;
    }

    public function isNombreDePortes5(): ?bool
    {
        return $this->nombreDePortes5;
    }

    public function setNombreDePortes5(?bool $nombreDePortes5): self
    {
        $this->nombreDePortes5 = $nombreDePortes5;

        return $this;
    }

    public function getPuissanceFiscale(): ?int
    {
        return $this->puissanceFiscale;
    }

    public function setPuissanceFiscale(int $puissanceFiscale): self
    {
        $this->puissanceFiscale = $puissanceFiscale;

        return $this;
    }

    public function getEmissionCO2(): ?int
    {
        return $this->emissionCO2;
    }

    public function setEmissionCO2(int $emissionCO2): self
    {
        $this->emissionCO2 = $emissionCO2;

        return $this;
    }

}
