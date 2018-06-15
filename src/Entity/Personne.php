<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneRepository")
 */
class Personne
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Doudou", mappedBy="personne")
     */
    private $doudous;

    public function __construct()
    {
        $this->doudous = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Doudou[]
     */
    public function getDoudous(): Collection
    {
        return $this->doudous;
    }

    public function addDoudous(Doudou $doudous): self
    {
        if (!$this->doudous->contains($doudous)) {
            $this->doudous[] = $doudous;
            $doudous->setPersonne($this);
        }

        return $this;
    }

    public function removeDoudous(Doudou $doudous): self
    {
        if ($this->doudous->contains($doudous)) {
            $this->doudous->removeElement($doudous);
            // set the owning side to null (unless already changed)
            if ($doudous->getPersonne() === $this) {
                $doudous->setPersonne(null);
            }
        }

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
        ];
    }
}
