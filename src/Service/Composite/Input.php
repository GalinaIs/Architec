<?php

namespace Service\Composite;
/**
 * Элемент fieldset представляет собой Конкретный Контейнер.
 */
class Input extends Element
{
    private $type;
    private $value;

    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function render(): string
    {
        return "<input type=\"{$this->type}\" value=\"{$this->value}\" />";
    }
}