<?php
namespace Service\Product\SorterProduct;
use Model\Entity\Product;

class SorterProductByPrise implements SorterProduct{
    public function applySort(array &$productList) : void {
        usort($productList, function(Product $a,Product $b){
            return $a->getPrice() - $b->getPrice();
        });
    }
}