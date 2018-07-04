<?php
  require_once "vendor/autoload.php";
  require_once "config.php";

  use Monolog\Logger;
  use Monolog\Handler\PhpConsoleHandler;

  // Create the logger
  $logger = new Logger('my_logger');
  // Now add some handlers
  $logger->pushHandler(new PHPConsoleHandler());

  // You can now use your logger
  $logger->addInfo('My logger is now ready');



?>
