<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'orders')]
class Order {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    private ?string $reference = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Coupon $coupon = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'order_id', targetEntity: OrderDetail::class, orphanRemoval: true)]
    private Collection $orderDetails;

    #[ORM\Column( options:['default' => 'CURRENT_TIMESTAMP'] )]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;


    ### => constructor
    public function __construct() {
        $this->orderDetails = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }


    ### => for $id
    public function getId(): ?int {
        return $this->id;
    }

    ### => for $reference
    public function getReference(): ?string {
        return $this->reference;
    }

    public function setReference(string $reference): self {
        $this->reference = $reference;

        return $this;
    }

    ### => for $coupon
    public function getCoupon(): ?Coupon {
        return $this->coupon;
    }

    public function setCoupon(?Coupon $coupon): self {
        $this->coupon = $coupon;

        return $this;
    }

    ### => for $user
    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $user): self {
        $this->user = $user;

        return $this;
    }

    ### => for $oerder_details
    /**
     * @return Collection<int, OrderDetail>
     */
    public function getOrderDetails(): Collection {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetail $orderDetail): self {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->add($orderDetail);
            $orderDetail->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getOrderId() === $this) {
                $orderDetail->setOrderId(null);
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
