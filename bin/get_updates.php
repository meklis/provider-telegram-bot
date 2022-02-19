#!/usr/bin/env bash
<?php
require  __DIR__ . '/../app/init.php';

$core = \ProviderBot\Core\Core::getInstance();

try {
    $telegram = $core->getContainer()->get(\Longman\TelegramBot\Telegram::class);
    // Handle telegram getUpdates request
    $telegram->handleGetUpdates();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
     echo $e->getMessage();
}


