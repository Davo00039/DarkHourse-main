<?php

namespace App\Entity;

use App\Repository\SPRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SPRepository::class)]
class SP
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $Gia = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\ManyToOne(inversedBy: 'sPs')]
    private ?Category $cate = null;

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

    public function getGia(): ?float
    {
        return $this->Gia;
    }

    public function setGia(float $Gia): self
    {
        $this->Gia = $Gia;

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

    public function getCate(): ?Category
    {
        return $this->cate;
    }

    public function setCate(?Category $cate): self
    {
        $this->cate = $cate;

        return $this;
    }
}
