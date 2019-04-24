<?php

namespace Service\Composite;
/**
 * Базовый класс Контейнер реализует инфраструктуру для управления дочерними
 * объектами, повторно используемую всеми Конкретными Контейнерами.
 */
abstract class Composite extends Element
{
    /**
     * @var Element[]
     */
    protected $fields = [];

    /**
     * Методы добавления/удаления подобъектов.
     */
    public function add(Element $field): Element
    {
        $this->fields[] = $field;
        return $field;
    }

    /**
     * Базовая реализация рендеринга Контейнера просто объединяет результаты
     * всех дочерних элементов. Конкретные Контейнеры смогут повторно
     * использовать эту реализацию в своих реальных реализациях рендеринга.
     */
    public function render(): string
    {
        $output = "";

        foreach ($this->fields as $field) {
            $output .= $field->render();
            
        }

        return $output;
    }
}