<?php

chdir(dirname(__DIR__));

require __DIR__ . '/../vendor/autoload.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();