<?php

namespace App\Entity;

use App\Repository\CouponRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
#[ORM\Table(name: 'coupons')] // rename table whene creating migration
class Coupon {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    private ?string $code = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $discount = null;

    #[ORM\Column]
    private ?int $max_usage = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $validity_date = null;

    #[ORM\Column]
    private ?bool $is_valid = null;

    #[ORM\ManyToOne(inversedBy: 'coupons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CouponType $coupons_types = null;

    #[ORM\OneToMany(mappedBy: 'coupon', targetEntity: Order::class)]
    private Collection $orders;

    #[ORM\Column( options:['default' => 'CURRENT_TIMESTAMP'] )]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;


    ### => conctructor
    public function __construct() {
        $this->orders = new ArrayCollection();
    }


    ### => for $id
    public function getId(): ?int {
        return $this->id;
    }

    ### => for $code
    public function getCode(): ?string {
        return $this->code;
    }

    public function setCode(string $code): self {
        $this->code = $code;

        return $this;
    }

    ### => for $description
    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = $description;

        return $this;
    }

    ### => for $discount
    public function getDiscount(): ?int {
        return $this->discount;
    }

    public function setDiscount(int $discount): self {
        $this->discount = $discount;

        return $this;
    }

    ### => for $max_usage
    public function getMaxUsage(): ?int {
        return $this->max_usage;
    }

    public function setMaxUsage(int $max_usage): self {
        $this->max_usage = $max_usage;

        return $this;
    }

    ### => for $validity
    public function getValidityDate(): ?\DateTimeInterface {
        return $this->validity_date;
    }

    public function setValidityDate(\DateTimeInterface $validity_date): self {
        $this->validity_date = $validity_date;

        return $this;
    }

    ### => for $is_valid
    public function isIsValid(): ?bool {
        return $this->is_valid;
    }

    public function setIsValid(bool $is_valid): self {
        $this->is_valid = $is_valid;

        return $this;
    }

    ### => for $coupon_types
    public function getCouponType(): ?CouponType {
        return $this->coupons_types;
    }

    public function setCouponType(?CouponType $coupons_types): self {
        $this->coupons_types = $coupons_types;

        return $this;
    }

    ### => for $orders
    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection {
        return $this->orders;
    }

    public function addOrder(Order $order): self {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setCoupon($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCoupon() === $this) {
                $order->setCoupon(null);
            }
        }

        return $this;
    }

    ### => for $created_at
    public function getCreatedAt(): ?\DateTimeImmutable {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    ### => for $updated_at
    public function getUpdatedAt(): ?\DateTimeImmutable {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self {
        $this->updated_at = $updated_at;

        return $this;
    }
}
