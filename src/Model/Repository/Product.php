<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;

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
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
