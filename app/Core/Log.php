<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('mylogger');
$log->pushHandler(new StreamHandler('logs/mylog.log', Logger::INFO));