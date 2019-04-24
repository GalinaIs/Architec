<?php

namespace Service\Order;

use Service\Discount\IDiscount;
use Service\Billing\IBilling;

class Order {
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

    public function __construct(OrderBuilder $orderBuilder)
    {
        $this->billing = $orderBuilder->getBilling();
        $this->discount = $orderBuilder->getDiscount();
        $this->listProduct = $orderBuilder->getListProduct();
    }

    /**
     * Проведение всех этапов заказа
     *
     * @return void
     */
    public function checkout(): void {
        $totalPrice = 0;
        foreach ($this->listProduct as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $this->discount->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $this->billing->pay($totalPrice);
    }

}