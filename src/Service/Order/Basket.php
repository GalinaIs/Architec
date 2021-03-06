<?php

declare(strict_types = 1);

namespace Service\Order;

use Model;
use Service\User\Security;
use Service\Communication\OrderObserver\OrderObserver;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Service\Communication\OrderObserver\Observer;
use Model\Entity\User;

class Basket implements SubjectCommunication
{
    private $observer = [];
    /**
     * Сессионный ключ списка всех продуктов корзины
     */
    private const BASKET_DATA_KEY = 'basket';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Добавляем товар в заказ
     *
     * @param int $product
     *
     * @return void
     */
    public function addProduct(int $product): void
    {
        $basket = $this->session->get(static::BASKET_DATA_KEY, []);
        if (!in_array($product, $basket, true)) {
            $basket[] = $product;
            $this->session->set(static::BASKET_DATA_KEY, $basket);
        }
    }

    /**
     * Проверяем, лежит ли продукт в корзине или нет
     *
     * @param int $productId
     *
     * @return bool
     */
    public function isProductInBasket(int $productId): bool
    {
        return in_array($productId, $this->getProductIds(), true);
    }

    /**
     * Получаем информацию по всем продуктам в корзине
     *
     * @return Model\Entity\Product[]
     */
    public function getProductsInfo(): array
    {
        $productIds = $this->getProductIds();
        return $this->getProductRepository()->search($productIds);
    }

    /**
     * Оформление заказа
     *
     * @return void
     */
    public function checkout(): void
    {
        OrderObserver::createOrderObserver($this);

        $this->checkoutProccess();
        
        $security = new Security($this->session);
        $user = $security->getUser();
        $this->notify($user);
    }

    public function checkoutProccess():void {
        (new FacadeOrder($this->getProductsInfo()))->checkout();
    }

    /**
     * Фабричный метод для репозитория Product
     *
     * @return Model\Repository\Product
     */
    protected function getProductRepository(): Model\Repository\Product
    {
        return new Model\Repository\Product();
    }

    /**
     * Получаем список id товаров корзины
     *
     * @return array
     */
    private function getProductIds(): array
    {
        return $this->session->get(static::BASKET_DATA_KEY, []);
    }

    public function attach(Observer $observer):void {
        $this->observer[] = $observer;
    }

    public function detach(Observer $observer):void {
        $key = array_search($observer, $this->observer);
        if ($key!=null)
            unset($this->observer[$key]);
    }

    public function notify(User $user) : void {
        foreach($this->observer as $observer) 
            $observer->update($user, 'checkout_template');
    }
}