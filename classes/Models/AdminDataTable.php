<?php

namespace Models;

class AdminDataTable extends \Models\Model
{
    public $arrModels;
    public $arrFunction;
    public $dataTable;

    public function __construct($arrModels, $arrFunction)
    {
        $this->arrModels = $arrModels;
        $this->arrFunction = $arrFunction;
    }

    public function render()
    {
        foreach ($this->arrModels as $num => $molel) {
            foreach ($this->arrFunction as $key => $function) {
                $this->dataTable[$num][] = $function($molel);
            }
        }
        return $this->dataTable;
    }
}
