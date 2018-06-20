<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type implements \JsonSerializable
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
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Doudou", mappedBy="type")
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

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
            "label" => $this->getLabel(),
        ];
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
            $doudous->setType($this);
        }

        return $this;
    }

    public function removeDoudous(Doudou $doudous): self
    {
        if ($this->doudous->contains($doudous)) {
            $this->doudous->removeElement($doudous);
            // set the owning side to null (unless already changed)
            if ($doudous->getType() === $this) {
                $doudous->setType(null);
            }
        }

        return $this;
    }
}
