<?php

namespace Service\Order;

use Service\Billing\Card;
use Service\Discount\NullObject;

class FacadeOrder {
    /**
     * @var OrderBuilder
     */
    private $orderBuilder;

    public function __construct(array $productList)
    {
        $this->orderBuilder = new OrderBuilder();
        $this->orderBuilder->setBilling(new Card());
        $this->orderBuilder->setDiscount(new NullObject());
        $this->orderBuilder->setListProduct($productList);
    }

    public function checkout():void {
        $this->orderBuilder->build()->checkout();
    }
}