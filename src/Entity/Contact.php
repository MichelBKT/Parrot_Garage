<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min:2, max:50)]
    private ?string $titre = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min:2, max:50)]
    #[Assert\Regex(
        pattern: '/\d/',
        match: false,
        message: 'Votre nom ne peut pas contenir un nombre'
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min:2, max:50)]
    #[Assert\Regex(
        pattern: '/\d/',
        match: false,
        message: 'Votre prénom ne peut pas contenir un nombre'        
    )]
    private ?string $prenom = null;

    #[ORM\Column(length: 180)]
    #[Assert\Email()]
    #[Assert\Length(min:2, max:180)]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(min:2, max:100)]
    private ?string $objet = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    private ?string $sujet = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Lu = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->titre = $Titre;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $Nom): self
    {
        $this->nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function isLu(): ?bool
    {
        return $this->Lu;
    }

    public function setLu(?bool $Lu): static
    {
        $this->Lu = $Lu;

        return $this;
    }


}