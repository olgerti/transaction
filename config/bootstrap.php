<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

$builder = new DI\ContainerBuilder;
$builder->addDefinitions(__DIR__.'/config.php');
$container = $builder->build();

