<?php

namespace Service\Composite;
/**
 * Так же как и элемент формы.
 */
class Form extends Composite
{
    public function render(): string
    {
        $output = parent::render();
        return "<form method=\"post\">\n$output</form>\n";
    }
}
