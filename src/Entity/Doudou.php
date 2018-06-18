<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoudouRepository")
 */
class Doudou implements \JsonSerializable
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
    private $lieuDecouverte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lng;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDecouverte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="doudous")
     */
    private $personne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="doudous")
     */
    private $type;

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

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(?float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getDateDecouverte(): ?\DateTimeInterface
    {
        return $this->dateDecouverte;
    }

    public function setDateDecouverte(?\DateTimeInterface $dateDecouverte): self
    {
        $this->dateDecouverte = $dateDecouverte;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): self
    {
        $this->personne = $personne;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return[
            "id" => $this->getId(),
            "color" => $this->getCouleur(),
            "dateFind" => $this->getDateDecouverte(),
            "placeFind" => $this->getLieuDecouverte(),
            "type" => [
                "label" => $this->getType(),
                ],
            "lat" => $this->getLat(),
            "lng" => $this->getLng(),
            "image" => $this->getPhoto(),
            "personne" => [
                "prenom" => $this->getPersonne()->getFirstname(),
                "nom" => $this->getPersonne()->getLastname(),
                "email" => $this->getPersonne()->getEmail(),
                ],
        ];
    }



}
