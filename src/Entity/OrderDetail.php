<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
#[ORM\Table(name: 'orders_details')] // rename table whene creating migration
class OrderDetail {
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?int $price = null;


    ### => for $id for order_id
    public function getOrderId(): ?Order {
        return $this->order;
    }

    public function setOrderId(?Order $order): self {
        $this->order = $order;

        return $this;
    }

    ### => for $product_id
    public function getProductId(): ?Product {
        return $this->product;
    }

    public function setProductId(?Product $product): self {
        $this->product = $product;

        return $this;
    }

    ### => for $quantity
    public function getQuantity(): ?int {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self {
        $this->quantity = $quantity;

        return $this;
    }

    ### => for $price
    public function getPrice(): ?int {
        return $this->price;
    }

    public function setPrice(int $price): self {
        $this->price = $price;

        return $this;
    }
}
