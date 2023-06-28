<?php

namespace App\Entity;

use App\Repository\SmartphoneRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SmartphoneRepository::class)]
class Smartphone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imeiNumber = null;

    #[ORM\Column]
    private ?int $ramNumber = null;

    #[ORM\Column]
    private ?int $stockageNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $screenSize = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $networkSpeed = null;

    #[ORM\Column(nullable: true)]
    private ?int $yearManufacture = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $basePrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $devicePicturePath = null;

    #[ORM\Column(nullable: true)]
    private ?float $rateCo2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImeiNumber(): ?string
    {
        return $this->imeiNumber;
    }

    public function setImeiNumber(?string $imeiNumber): static
    {
        $this->imeiNumber = $imeiNumber;

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

    public function getStockageNumber(): ?int
    {
        return $this->stockageNumber;
    }

    public function setStockageNumber(int $stockageNumber): static
    {
        $this->stockageNumber = $stockageNumber;

        return $this;
    }

    public function getScreenSize(): ?int
    {
        return $this->screenSize;
    }

    public function setScreenSize(?int $screenSize): static
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getNetworkSpeed(): ?string
    {
        return $this->networkSpeed;
    }

    public function setNetworkSpeed(?string $networkSpeed): static
    {
        $this->networkSpeed = $networkSpeed;

        return $this;
    }

    public function getYearManufacture(): ?int
    {
        return $this->yearManufacture;
    }

    public function setYearManufacture(?int $yearManufacture): static
    {
        $this->yearManufacture = $yearManufacture;

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

    public function getDevicePicturePath(): ?string
    {
        return $this->devicePicturePath;
    }

    public function setDevicePicturePath(?string $devicePicturePath): static
    {
        $this->devicePicturePath = $devicePicturePath;

        return $this;
    }

    public function getRateCo2(): ?float
    {
        return $this->rateCo2;
    }

    public function setRateCo2(?float $rateCo2): static
    {
        $this->rateCo2 = $rateCo2;

        return $this;
    }
}