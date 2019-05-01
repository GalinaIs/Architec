<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;
use Model\Mapper\Product as MapperProduct;

class Product
{
    /**
     * Поиск продуктов по массиву id
     *
     * @param int[] $ids
     * @return Entity\Product[]
     */
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        $productList = [];
        $productDefault = new Entity\Product(0, "", 0);
        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
            $productList[] = $this->cloneProduct($productDefault, $item);
        }

        return $productList;
    }

    /**
     * Клонирование объекта продукта с установкой нужных свойств
     */
    private function cloneProduct(Entity\Product $productDefault, $item):Entity\Product {
        $product = clone $productDefault;
        $product->setId($item['id']);
        $product->setName($item['name']);
        $product->setPrice($item['price']);
        return $product;
    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
    public function fetchAll(): array
    {
        $productList = [];
        foreach ($this->getDataFromSource() as $item) {
            $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
        }

        return $productList;
    }

    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = (new MapperProduct())->selectAll();

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
