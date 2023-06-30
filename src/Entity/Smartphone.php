<?php

namespace App\Entity;

use App\Repository\SmartphoneRepository;
use App\Service\CalculateCarbonService;
use App\Service\CalculatePriceService;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SmartphoneRepository::class)]
class Smartphone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]
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

    #[ORM\Column(nullable: true)]
    private ?int $ponderation = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $basePrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $devicePicturePath = null;

    #[ORM\Column(nullable: true)]
    private ?float $rateCo2 = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $operator = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Model $Model = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $estimateAt = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $calculatePrice = null;

    public function __construct(private CalculatePriceService $calculatePriceService, private CalculateCarbonService $calculateCarbonService)
    {
        $this->estimateAt = new \DateTimeImmutable();
    }
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

    public function getOperator(): ?User
    {
        return $this->operator;
    }

    public function setOperator(?User $operator): static
    {
        $this->operator = $operator;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->Model;
    }

    public function setModel(?Model $Model): static
    {
        $this->Model = $Model;

        return $this;
    }

    /**
     * Get the value of ponderation
     */
    public function getPonderation()
    {
        return $this->ponderation;
    }

    /**
     * Set the value of ponderation
     *
     * @return  self
     */
    public function setPonderation($ponderation)
    {
        $this->ponderation = $ponderation;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getEstimateAt(): ?\DateTimeImmutable
    {
        return $this->estimateAt;
    }

    public function setEstimateAt(\DateTimeImmutable $estimateAt): static
    {
        $this->estimateAt = $estimateAt;

        return $this;
    }

    public function getCalculatePrice(): ?string
    {
        return $this->calculatePrice;
    }

    public function setCalculatePrice(string $calculatePrice): static
    {
        $this->calculatePrice = $calculatePrice;

        return $this;
    }

    // public function getCategorie(): ?string
    // {
    //     if (isset($this)) {
    //         if (!empty($this->basePrice) && isset($this->ramNumber) && isset($this->stockageNumber)) {
    //             return $this->calculatePriceService->getPriceCategory($this);
    //         } else {
    //             return "undefined";
    //         }
    //     }
    // }

    // public function getCarbonne(): ?int
    // {
    //     if (isset($this)) {
    //         return $this->calculateCarbonService->getCarbonne($this);
    //     }
    // }
}
