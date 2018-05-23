<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoudouRepository")
 */
class Doudou
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Couleur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $coordGPS;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieuDecouverte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    public function getId()
    {
        return $this->id;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(?string $Couleur): self
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCoordGPS(): ?float
    {
        return $this->coordGPS;
    }

    public function setCoordGPS(?float $coordGPS): self
    {
        $this->coordGPS = $coordGPS;

        return $this;
    }

    public function getLieuDecouverte(): ?string
    {
        return $this->lieuDecouverte;
    }

    public function setLieuDecouverte(?string $lieuDecouverte): self
    {
        $this->lieuDecouverte = $lieuDecouverte;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
