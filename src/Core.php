<?php

namespace ProviderBot\Core;

use DI\Container;

class Core
{
    /**
     * @var Core
     */
    protected static $core;

    /**
     * @return Core
     */
    public static function getInstance() {
        return self::$core;
    }

    /**
     * @var Container
     */
    protected $di;

    function __construct(Container $di)
    {
        $di->set(Core::class, $this);
        $this->di = $di;
        self::$core = $this;
    }

    /**
     * @return Container
     */
    function getContainer() {
        return $this->di;
    }
}