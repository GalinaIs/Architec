<?php

namespace Service\Order;

use Service\Communication\OrderObserver\Observer;
use Model\Entity\User;

interface SubjectCommunication {
    /**
     * Объект, за которым нужно наблюдать
     * 
     */
    public function attach(Observer $observer) : void;
    public function detach(Observer $observer) : void;
    public function notify (User $user) : void;
}