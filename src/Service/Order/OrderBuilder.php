<?php

namespace Service\Order;

use Service\Discount\IDiscount;
use Service\Billing\IBilling;

class OrderBuilder {
    /**
     * @var IBilling
     */
    private $billing;
    /**
     * @var IDiscount
     */
    private $discount;
      
    /**
     * @var Model\Entity\Product[]
     */
    private $listProduct;

    public function setDiscount(IDiscount $discount):void {
        $this->discount = $discount;
    }

    public function getDiscount():IDiscount {
        return $this->discount;
    }

    public function setBilling(IBilling $billing):void {
        $this->billing = $billing;
    }

    public function getBilling():IBilling {
        return $this->billing;
    }

    public function setListProduct(array $listProduct):void {
        $this->listProduct = $listProduct;
    }

    public function getListProduct():array {
        return $this->listProduct;
    }

    public function build():Order {
        return new Order($this);
    }
}