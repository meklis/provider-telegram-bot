<?php
declare(strict_types=1);

$_ENV['ROOT_DIR'] = realpath(__DIR__ . '/../');

error_reporting(E_ALL);
set_error_handler(function ($severity, $message, $file, $line) {
    if (error_reporting() & $severity) {
        throw new ErrorException($message . " on file $file, line: $line", 0, $severity, $file, $line);
    }
});


require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

//Set default timezone from system
if(file_exists('/etc/timezone')) {
    date_default_timezone_set(trim(file_get_contents('/etc/timezone')));
}

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->useAnnotations(true);
$containerBuilder->useAutowiring(true);

// Set up dependencies
$dependencies = require __DIR__ .'/dependencies.php';
$dependencies($containerBuilder);

// Build PHP-DI Container instance
/**
 * @var \DI\Container
 */
$container = $containerBuilder->build();

$core = new \ProviderBot\Core\Core($container);


function env($key, $default_value = null) {
    if(isset($_ENV[$key])) {
        $value = $_ENV[$key];
    } else {
        $value = $default_value;
    }
    if(strpos($value, "\${") !== false) {
        foreach ($_ENV as $key => $val) {
            $value = str_replace("\$\{$key\}", $val, $value);
        }
    }
    if(strtolower($value) === 'yes') return  true;
    if(strtolower($value) === 'no') return  false;
    return $value;
}
