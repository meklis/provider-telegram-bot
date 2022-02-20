#!/usr/bin/env bash
<?php
require __DIR__ . '/../app/init.php';

$core = \ProviderBot\Core\Core::getInstance();
$telegram = $core->getContainer()->get(\Longman\TelegramBot\Telegram::class);

try {
// Unset / delete the webhook
$result = $telegram->deleteWebhook();
echo $result->getDescription();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e->getMessage();
}