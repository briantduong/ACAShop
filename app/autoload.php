<?php
require(__DIR__ . DIRECTORY_SEPARATOR . 'functions.php');

date_default_timezone_set('America/Chicago');

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__ . '/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
