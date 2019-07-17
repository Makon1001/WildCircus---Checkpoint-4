<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpectacleRepository")
 */
class Spectacle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\Column(type="integer")
     */
    private $placeDispo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reservation", mappedBy="spectacle")
     */
    private $reservations;

    /**
     * @ORM\Column(type="float")
     */
    private $tarifEnfantSemaine;

    /**
     * @ORM\Column(type="float")
     */
    private $tarifEnfantWE;

    /**
     * @ORM\Column(type="float")
     */
    private $tarifAdultSemaine;

    /**
     * @ORM\Column(type="float")
     */
    private $tarifAdultWE;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ville", inversedBy="spectacle")
     */
    private $villes;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->villes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPlaceDispo(): ?int
    {
        return $this->placeDispo;
    }

    public function setPlaceDispo(int $placeDispo): self
    {
        $this->placeDispo = $placeDispo;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->addSpectacle($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            $reservation->removeSpectacle($this);
        }

        return $this;
    }

    public function getTarifEnfantSemaine(): ?float
    {
        return $this->tarifEnfantSemaine;
    }

    public function setTarifEnfantSemaine(float $tarifEnfantSemaine): self
    {
        $this->tarifEnfantSemaine = $tarifEnfantSemaine;

        return $this;
    }

    public function getTarifEnfantWE(): ?float
    {
        return $this->tarifEnfantWE;
    }

    public function setTarifEnfantWE(float $tarifEnfantWE): self
    {
        $this->tarifEnfantWE = $tarifEnfantWE;

        return $this;
    }

    public function getTarifAdultSemaine(): ?float
    {
        return $this->tarifAdultSemaine;
    }

    public function setTarifAdultSemaine(float $tarifAdultSemaine): self
    {
        $this->tarifAdultSemaine = $tarifAdultSemaine;

        return $this;
    }

    public function getTarifAdultWE(): ?float
    {
        return $this->tarifAdultWE;
    }

    public function setTarifAdultWE(float $tarifAdultWE): self
    {
        $this->tarifAdultWE = $tarifAdultWE;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|Ville[]
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->addSpectacle($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->villes->contains($ville)) {
            $this->villes->removeElement($ville);
            $ville->removeSpectacle($this);
        }

        return $this;
    }
}
