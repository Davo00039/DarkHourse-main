<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'cate', targetEntity: SP::class)]
    private Collection $sPs;

    public function __construct()
    {
        $this->sPs = new ArrayCollection();
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
     * @return Collection<int, SP>
     */
    public function getSPs(): Collection
    {
        return $this->sPs;
    }

    public function addSP(SP $sP): self
    {
        if (!$this->sPs->contains($sP)) {
            $this->sPs->add($sP);
            $sP->setCate($this);
        }

        return $this;
    }

    public function removeSP(SP $sP): self
    {
        if ($this->sPs->removeElement($sP)) {
            // set the owning side to null (unless already changed)
            if ($sP->getCate() === $this) {
                $sP->setCate(null);
            }
        }

        return $this;
    }
}
