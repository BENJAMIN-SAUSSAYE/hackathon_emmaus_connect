<?php

namespace App\Entity;

use App\Repository\ImeiDeviceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImeiDeviceRepository::class)]
class ImeiDevice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $imeiNumber = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Model $model = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImeiNumber(): ?string
    {
        return $this->imeiNumber;
    }

    public function setImeiNumber(string $imeiNumber): static
    {
        $this->imeiNumber = $imeiNumber;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }
}
