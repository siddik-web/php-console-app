#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\ClearCacheCommand;
use App\TimeCommand;
use Symfony\Component\Console\Application;

$app = new Application('Console App', 'v1.0.0');
$app->add(new TimeCommand());
$app->add(new ClearCacheCommand());
$app -> run();
