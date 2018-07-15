<?php
  require_once "vendor/autoload.php";
  require_once "config.php";

  use Monolog\Logger;
  use Monolog\Formatter\JsonFormatter;
  use Monolog\Handler\PhpConsoleHandler;
  use Monolog\Handler\StreamHandler;

  // Create the logger
  $logger = new Logger('my_logger');
  // Now add some handlers
  $logger->pushHandler(new PHPConsoleHandler());


  $formatter = new JsonFormatter();
  // Create a handler
  $stream = new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG);
  $stream->setFormatter($formatter);
  // bind it to a logger object
  $logger->pushHandler($stream);

  try {
    $listener = new \AmoCRM\Webhooks\Listener();

    // Добавление обработчика на уведомление contacts->add
    $listener->on('add_contact', function ($domain, $id, $data) {
        // $domain Поддомен amoCRM
        // $id Id объекта связанного с уведомлением
        // $data Поля возвращаемые уведомлением
        $GLOBALS["logger"]->info($domain);
        $GLOBALS["logger"]->debug($data);
    });

    // Вызов обработчика уведомлений
    $listener->listen();

  } catch (\AmoCRM\Exception $e) {
    $logger->error(sprintf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage()));
  }

?>
