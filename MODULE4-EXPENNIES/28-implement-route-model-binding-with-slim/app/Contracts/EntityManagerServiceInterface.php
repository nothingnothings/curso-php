<?php declare(strict_types=1);

namespace App\Contracts;

/**
 * @mixin EntityManagerServiceInterface
 */
interface EntityManagerServiceInterface
{
    public function __call(string $name, array $args);

    public function sync($entity = null): void;

    public function delete($entity, bool $sync = false): void;

    public function clear(string $entityName = null): void;
}
