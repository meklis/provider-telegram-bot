<?php

namespace ProviderBot\Core;

class Config
{
    protected $config;
    function __construct($confPath)
    {
        $this->config = require $confPath;
    }

    /**
     * @param $param
     * @param null $default
     * @return mixed|null
     */
    function conf($param, $default = null) {
        $elements = explode(".", $param);
        $arrayKey = join('', array_map(function ($e) {
            return "['{$e}']";
        }, $elements));
        $return = $default;
        $evalArrayBlock = "if(isset(\$this->config{$arrayKey})) {\$return = \$this->config{$arrayKey}; }";
        eval($evalArrayBlock);
        return $return;
    }
}