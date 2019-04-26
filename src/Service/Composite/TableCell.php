<?php

namespace Service\Composite;

class TableCell extends Composite
{
    private $info;
    private $colspan;
    private $align;

    public function __construct($info = "", int $colspan = -1, string $align = null)
    {
        $this->info = $info;
        $this->colspan = $colspan;
        $this->align = $align;
    }

    public function render(): string
    {
        $output = parent::render();

        if ($this->colspan == -1 || $this->align == null)
            return "<td>{$this->info}\n$output</td>";

        return "<td colspan=\"{$this->colspan}\" align=\"{$this->align}\">{$this->info}\n{$output}</td>";
    }
}