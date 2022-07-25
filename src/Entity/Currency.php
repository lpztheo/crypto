<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CurrencyRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *          "get"
 *     },
 *     itemOperations={
 *          "get"
 *     },
 *     normalizationContext={"groups"={"currency:read"}},
 *
 *
 * )
 */

class Currency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"currency:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"currency:read"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Owned::class, mappedBy="currency", orphanRemoval=true)
     */
    private $owneds;

    /**
     * @ORM\OneToMany(targetEntity=Evolution::class, mappedBy="currency", orphanRemoval=true)
     */
    private $evolutions;

    public function __construct()
    {
        $this->owneds = new ArrayCollection();
        $this->evolutions = new ArrayCollection();
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

    /**
     * @return Collection<int, Owned>
     */
    public function getOwneds(): Collection
    {
        return $this->owneds;
    }

    public function addOwned(Owned $owned): self
    {
        if (!$this->owneds->contains($owned)) {
            $this->owneds[] = $owned;
            $owned->setCurrency($this);
        }

        return $this;
    }

    public function removeOwned(Owned $owned): self
    {
        if ($this->owneds->removeElement($owned)) {
            // set the owning side to null (unless already changed)
            if ($owned->getCurrency() === $this) {
                $owned->setCurrency(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evolution>
     */
    public function getEvolutions(): Collection
    {
        return $this->evolutions;
    }

    public function addEvolution(Evolution $evolution): self
    {
        if (!$this->evolutions->contains($evolution)) {
            $this->evolutions[] = $evolution;
            $evolution->setCurrency($this);
        }

        return $this;
    }

    public function removeEvolution(Evolution $evolution): self
    {
        if ($this->evolutions->removeElement($evolution)) {
            // set the owning side to null (unless already changed)
            if ($evolution->getCurrency() === $this) {
                $evolution->setCurrency(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
