<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'User')]
    private ?Poste $poste = null;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Annonce::class)]
    private Collection $user;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Entretien::class)]
    private Collection $entretien;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Service::class)]
    private Collection $service;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->entretien = new ArrayCollection();
        $this->service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPoste(): ?poste
    {
        return $this->poste;
    }

    public function setPoste(?poste $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * @return Collection<int, annonce>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(annonce $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setUser($this);
        }

        return $this;
    }

    public function removeUser(annonce $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getUser() === $this) {
                $user->setUser(null);
            }
        }

        return $this;
    }

       /**
     * @return Collection<int, entretien>
     */
    public function getEntretien(): Collection
    {
        return $this->entretien;
    }

    public function addEntretien(entretien $entretien): self
    {
        if (!$this->entretien->contains($entretien)) {
            $this->entretien->add($entretien);
            $entretien->setUser($this);
        }

        return $this;
    }

    public function removeEntretien(entretien $entretien): self
    {
        if ($this->entretien->removeElement($entretien)) {
            // set the owning side to null (unless already changed)
            if ($entretien->getUser() === $this) {
                $entretien->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, service>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(service $service): self
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
            $service->setUser($this);
        }

        return $this;
    }

    public function removeService(service $service): self
    {
        if ($this->service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getUser() === $this) {
                $service->setUser(null);
            }
        }

        return $this;
    }
}
