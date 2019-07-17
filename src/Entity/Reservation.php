<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $school;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomEtablissement;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbEnfant;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbAdulte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Spectacle", inversedBy="reservations")
     */
    private $spectacle;

    public function __construct()
    {
        $this->spectacle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchool(): ?bool
    {
        return $this->school;
    }

    public function setSchool(bool $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nomEtablissement;
    }

    public function setNomEtablissement(?string $nomEtablissement): self
    {
        $this->nomEtablissement = $nomEtablissement;

        return $this;
    }

    public function getNbEnfant(): ?int
    {
        return $this->nbEnfant;
    }

    public function setNbEnfant(int $nbEnfant): self
    {
        $this->nbEnfant = $nbEnfant;

        return $this;
    }

    public function getNbAdulte(): ?int
    {
        return $this->nbAdulte;
    }

    public function setNbAdulte(int $nbAdulte): self
    {
        $this->nbAdulte = $nbAdulte;

        return $this;
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
     * @return Collection|Spectacle[]
     */
    public function getSpectacle(): Collection
    {
        return $this->spectacle;
    }

    public function addSpectacle(Spectacle $spectacle): self
    {
        if (!$this->spectacle->contains($spectacle)) {
            $this->spectacle[] = $spectacle;
        }

        return $this;
    }

    public function removeSpectacle(Spectacle $spectacle): self
    {
        if ($this->spectacle->contains($spectacle)) {
            $this->spectacle->removeElement($spectacle);
        }

        return $this;
    }
}
