<?php

namespace Service\Composite;

/**
 * @param Model\Entity\Product[] productList
 * 
 * @return Element
 */
class FormCheckout {
    static function getForm(array $productList, bool $isLogged): Element
    {
        $form = new Form();

        $table = new Table(10);

        $table->add(new TableRow())
            ->add(new TableCell("Корзина", 3, "center"));

        $sum = FormCheckout::loadProductInfo($productList, $table);

        $table->add(new TableRow())
            ->add(new TableCell("Итого: {$sum} рублей", 3, "right"));

        if ($sum > 0) {
            FormCheckout::createBottomTable($isLogged, $table);
        }

        $form->add($table);
        return $form;
    }

    private static function createBottomTable(bool $isLogged, Element $table) {
        if ($isLogged) {
            $table->add(new TableRow())
                ->add(new TableCell("", 3, "center"))
                ->add(new Input("submit", "Оформить заказ"));
        } else {
            $table->add(new TableRow())
                ->add(new TableCell("Для оформления заказа, авторизуйтесь", 4, "center"));
        }
    }


    /**
     * @param Model\Entity\Product[] productList
     * 
     * @return int
     */
    private static function loadProductInfo(array $productList, Element $table)
    {
        $count = 0;
        $sum = 0;
        foreach ($productList as $product) {
            $tableRow = new TableRow();
            $tableRow->add(new TableCell(++$count));
            $tableRow->add(new TableCell($product->getName()));
            $tableRow->add(new TableCell($product->getPrice()));

            $tableCell = new TableCell();
            $tableCell->add(new Input("button", "Удалить"));
            $tableRow->add($tableCell);

            $table->add($tableRow);

            $sum += $product->getPrice();
        }
        return $sum;
    }
}