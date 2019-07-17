<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
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
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Spectacle", mappedBy="villes")
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
