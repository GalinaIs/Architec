<?php
namespace Service\Product\SorterProduct;

use Service\Product\SorterProduct\SorterProductByName;
use Service\Product\SorterProduct\SorterProductByPrise;
/**
 * Отпределяем объект-сортировщик 
 *
 * @param string $sortType
 * @return Service\Product\SorterProduct|null
 */
class DefineSorterProduct {

    public static function defineSorter(string $sortType) {
        switch ($sortType) {
            case 'price': 
                return new SorterProductByPrise();
            case 'name':
                return new SorterProductByName();
            default:
                null;
        }
    }
    
}