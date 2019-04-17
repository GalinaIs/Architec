<?php

declare(strict_types = 1);
 
namespace Service\Communication\OrderObserver;

use Service\Order\Basket;
use Service\Communication\Email;
use Service\Communication\Sms;

class OrderObserver {
    /**
     * Добавляем слушателей на событие - оформление заказа
     *
     * @return void
     */
    public static function createOrderObserver(Basket $basket) {
        //по какой-то логике выбираем уведомления все способы уведомления пользователя, например из БД, которые пользователь указал при регистрации
        $basket->attachObserver(new Email());
        $basket->attachObserver(new Sms());
    }
}