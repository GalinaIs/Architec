<?php
namespace Service\Product\SorterProduct;
use Model\Entity\Product;

class SorterProductByName implements SorterProduct{
    public function applySort(array &$productList) : void {
        usort($productList, function(Product $a,Product $b){
            return strcmp($a->getName(),$b->getName());
        });
    }
}