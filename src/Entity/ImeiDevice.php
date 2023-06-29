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

    #[ORM\Column]
    private ?int $screenSize = null;

    #[ORM\Column]
    private ?int $yearManufacture = null;

    #[ORM\Column(length: 25)]
    private ?string $networkSpeed = null;

    #[ORM\Column]
    private ?int $stockageNumber = null;

    #[ORM\Column]
    private ?int $ramNumber = null;

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

    public function getScreenSize(): ?int
    {
        return $this->screenSize;
    }

    public function setScreenSize(int $screenSize): static
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getYearManufacture(): ?int
    {
        return $this->yearManufacture;
    }

    public function setYearManufacture(int $yearManufacture): static
    {
        $this->yearManufacture = $yearManufacture;

        return $this;
    }

    public function getNetworkSpeed(): ?string
    {
        return $this->networkSpeed;
    }

    public function setNetworkSpeed(string $networkSpeed): static
    {
        $this->networkSpeed = $networkSpeed;

        return $this;
    }

    public function getStockageNumber(): ?int
    {
        return $this->stockageNumber;
    }

    public function setStockageNumber(int $stockageNumber): static
    {
        $this->stockageNumber = $stockageNumber;

        return $this;
    }

    public function getRamNumber(): ?int
    {
        return $this->ramNumber;
    }

    public function setRamNumber(int $ramNumber): static
    {
        $this->ramNumber = $ramNumber;

        return $this;
    }
}
