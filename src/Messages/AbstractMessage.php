<?php

namespace ProviderBot\Core\Messages;

use ProviderBot\Core\MessageObjects\Button;

abstract class AbstractMessage
{
    /**
     * @var string
     */
    protected $text = '';

    /**
     * @var string
     */
    protected $key = '';

    /**
     * @var []Button
     */
    protected $buttons = [];
}