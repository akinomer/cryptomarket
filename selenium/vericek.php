<?php

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

require_once('vendor/autoload.php');

$host = 'http://localhost:4444/wd/hub';

$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

$driver->get('https://www.coingecko.com/en');

$tr = $driver->findElement(WebDriverBy::cssSelector('tbody tr'));



$driver->quit();