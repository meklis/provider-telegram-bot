<?php



return function (\DI\ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
       \ProviderBot\Core\Config::class => function (\Psr\Container\ContainerInterface $c) {
            return new \ProviderBot\Core\Config(__DIR__ . '/../config/global.php');
        }
    ]);
    $containerBuilder->addDefinitions([
        Longman\TelegramBot\Telegram::class => function (\Psr\Container\ContainerInterface $c) {
            $config = $c->get(\ProviderBot\Core\Config::class);
            \Longman\TelegramBot\Request::setClient(new \GuzzleHttp\Client([
                'base_uri' => 'https://api.telegram.org',
                'verify' => false
            ]));
            $telegram = new Longman\TelegramBot\Telegram($config->conf('telegram.api_key'), $config->conf('telegram.username'));
            // Enable MySQL
            $telegram->enableMySql($config->conf('mysql'));
            return $telegram;
        }
    ]);
};