<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

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

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $basePrice = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brand = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function getBasePrice(): ?string
    {
        return $this->basePrice;
    }

    public function setBasePrice(string $basePrice): static
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }
}
