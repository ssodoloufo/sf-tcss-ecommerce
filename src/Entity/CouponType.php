<?php

namespace App\Entity;

use App\Repository\CouponTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponTypeRepository::class)]
#[ORM\Table(name: 'coupons_types')] // rename table whene creating migration
class CouponType {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'coupon_type', targetEntity: Coupon::class, orphanRemoval: true)]
    private Collection $coupons;


    ### => constructor
    public function __construct() {
        $this->coupons = new ArrayCollection();
    }
    

    ### => for $id
    public function getId(): ?int {
        return $this->id;
    }

    ### => for $name
    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    ### => for $coupon
    /**
     * @return Collection<int, Coupon>
     */
    public function getCoupons(): Collection {
        return $this->coupons;
    }

    public function addCoupon(Coupon $coupon): self {
        if (!$this->coupons->contains($coupon)) {
            $this->coupons->add($coupon);
            $coupon->setCouponType($this);
        }

        return $this;
    }

    public function removeCoupon(Coupon $coupon): self {
        if ($this->coupons->removeElement($coupon)) {
            // set the owning side to null (unless already changed)
            if ($coupon->getCouponType() === $this) {
                $coupon->setCouponType(null);
            }
        }

        return $this;
    }
}
