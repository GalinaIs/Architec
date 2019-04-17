<?php

namespace Service\Product\SorterProduct;

/**
 * Сортируем продукты 
 *
 * @param Model\Entity\Product[] $productList
 */
interface SorterProduct {
    public function applySort(array &$productList) : void;
}