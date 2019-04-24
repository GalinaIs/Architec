<?php

declare(strict_types = 1);

namespace Service\Product;

use Model;
use Service\Product\SorterProduct\DefineSorterProduct;

class Product
{
    /**
     * Получаем информацию по конкретному продукту
     *
     * @param int $id
     * @return Model\Entity\Product|null
     */
    public function getInfo(int $id): ?Model\Entity\Product
    {
        $product = $this->getProductRepository()->search([$id]);
        return count($product) ? $product[0] : null;
    }

    /**
     * Получаем все продукты
     *
     * @param string $sortType
     *
     * @return Model\Entity\Product[]
     */
    public function getAll(string $sortType): array
    {
        $productList = $this->getProductRepository()->fetchAll();

        // Применить паттерн Стратегия
        // $sortType === 'price'; // Сортировка по цене
        // $sortType === 'name'; // Сортировка по имени

        $sort = DefineSorterProduct::defineSorter($sortType);
        if ($sort != null) {
            $sort->applySort($productList);
        }
        
        return $productList;
    }

    /**
     * Фабричный метод для репозитория Product
     * Если реализовать контракт (интерфейс), со всеми методами из Model\Repository\Product, то при изменении места  хранения User в БД(по сути Entity\User на другой класс - Entity\AnotherUser) - другая база, другие поля, другая логика, то создаем класс Model\Repository\AnotherProduct и реализовываем новую логику работы с Entity\AnotherUser, а здесь всего лишь меняем new Model\Repository\Product() на new Model\Repository\AnotherProduct(). Ничего больше изменять не нужно будет (ну кроме типов - конкретные на интерфейсы). По сути уменьшаем зависимость от конкретных классов - знаем только контракт.
     * @return Model\Repository\Product
     */
    protected function getProductRepository(): Model\Repository\Product
    {
        return new Model\Repository\Product();
    }
}
