<?php

namespace Service\Composite;

class Table extends Composite
{
    protected $countCellPadding;

    public function __construct(int $countCellPadding)
    {
        $this->countCellPadding = $countCellPadding;
    }

    public function render(): string
    {
        $output = parent::render();
        return "<table cellpadding=\"{$this->countCellPadding}\">\n$output</table>";
    }
}
