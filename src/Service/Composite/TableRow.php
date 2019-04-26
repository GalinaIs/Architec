<?php

namespace Service\Composite;

class TableRow extends Composite
{
    public function render(): string
    {
        $output = parent::render();
        return "<tr>\n$output</tr>";
    }
}
