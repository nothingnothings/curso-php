<?php declare(strict_types=1);

use DI\ContainerBuilder;

// * Create Container, using PHP-DI (with custom bindings):
$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(__DIR__ . '/../configs/container_bindings.php');

return $containerBuilder->build();
