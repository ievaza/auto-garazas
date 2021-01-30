<?php

namespace App\Entity;

use App\Repository\MechanicsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MechanicsRepository::class)
 */
class Mechanics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity=Trucks::class, mappedBy="mechanic")
     */
    private $trucks;

    public function __construct()
    {
        $this->trucks = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection|Trucks[]
     */
    public function getTrucks(): Collection
    {
        return $this->trucks;
    }

    public function addTruck(Trucks $truck): self
    {
        if (!$this->trucks->contains($truck)) {
            $this->trucks[] = $truck;
            $truck->setMechanic($this);
        }

        return $this;
    }

    public function removeTruck(Trucks $truck): self
    {
        if ($this->trucks->removeElement($truck)) {
            // set the owning side to null (unless already changed)
            if ($truck->getMechanic() === $this) {
                $truck->setMechanic(null);
            }
        }

        return $this;
    }
}
