<?php

class Viev
{
    protected $data;

    public function assign($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function render($template)
    {
        ob_start();
        include $template;
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }

    public function display($template)
    {
        echo $this->render($template);
    }
}
