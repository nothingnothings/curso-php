<?php declare(strict_types=1);

use Doctrine\Migrations\Tools\Console\Command\CurrentCommand;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\Migrations\DependencyFactory;

// ! This won't work, because we don't have access to '$dependencyFactory'...
// return [
//     'commands' => [
//         // If you want to add your own custom console commands,
//         // you can do so here.
//         // * These are all commands taken from the Migrations Console Runner.
//         new CurrentCommand($dependencyFactory),
//         new DumpSchemaCommand($dependencyFactory),
//         new ExecuteCommand($dependencyFactory),
//         new GenerateCommand($dependencyFactory),
//         new LatestCommand($dependencyFactory),
//         new MigrateCommand($dependencyFactory),
//         new RollupCommand($dependencyFactory),
//         new StatusCommand($dependencyFactory),
//         new VersionCommand($dependencyFactory),
//         new UpToDateCommand($dependencyFactory),
//         new SyncMetadataCommand($dependencyFactory),
//         new ListCommand($dependencyFactory),
//         new DiffCommand($dependencyFactory),
//     ],
// ];

// * We use a closure, so we get access to the '$dependencyFactory'.
return fn(DependencyFactory $dependencyFactory) => [
    new CurrentCommand($dependencyFactory),
    new DumpSchemaCommand($dependencyFactory),
    new ExecuteCommand($dependencyFactory),
    new GenerateCommand($dependencyFactory),
    new LatestCommand($dependencyFactory),
    new MigrateCommand($dependencyFactory),
    new RollupCommand($dependencyFactory),
    new StatusCommand($dependencyFactory),
    new VersionCommand($dependencyFactory),
    new UpToDateCommand($dependencyFactory),
    new SyncMetadataCommand($dependencyFactory),
    new ListCommand($dependencyFactory),
    new DiffCommand($dependencyFactory),
];