#!/usr/bin/env bash
<?php
require __DIR__ . '/../app/init.php';

$core = \ProviderBot\Core\Core::getInstance();
// Handle telegram getUpdates request

try {
    // Create Telegram API object
    $telegram = $core->getContainer()->get(\Longman\TelegramBot\Telegram::class);

    /**
     * Check `hook.php` for configuration code to be added here.
     */

    // Handle telegram getUpdates request
    while(true) {
        $server_response = $telegram->handleGetUpdates();

        if ($server_response->isOk()) {
            $update_count = count($server_response->getResult());
            foreach ($server_response->getResult() as $result) {

            }
            echo date('Y-m-d H:i:s') . ' - Processed ' . $update_count . ' updates' . "\n";
        } else {
            echo date('Y-m-d H:i:s') . ' - Failed to fetch updates' . PHP_EOL;
            echo $server_response->printError();
        }
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);

    // Uncomment this to output any errors (ONLY FOR DEVELOPMENT!)
    echo $e;
}

