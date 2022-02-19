<?php

namespace ProviderBot\Core;

class Helper
{
    public static function env($name, $defaultValue = '') {
        return env($name, $defaultValue);
    }
}