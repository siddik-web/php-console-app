#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Commands\GenerateComponentCommand;
use Symfony\Component\Console\Application;

$app = new Application('Joomla 4 Extension Generator', 'v1.0.0');
$app->add(new GenerateComponentCommand());
$app->setDefaultCommand('generate:component', true);
$app ->run();
