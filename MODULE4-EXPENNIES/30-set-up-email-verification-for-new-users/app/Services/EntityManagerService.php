<?php declare(strict_types=1);

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;


/**
 * @mixin EntityManagerInterface
 */
class EntityManagerService
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __call(string $name,  array $args)
    {
        if (method_exists($this->entityManager, $name)) {
            return call_user_func_array([$this->entityManager, $name], $args);
        }

        throw new \BadMethodCallException("Method $name does not exist on EntityManagerService");
    }

    public function sync($entity = null): void
    {
        if ($entity) {
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
    }

    public function delete($entity, bool $sync = false): void
    {
        $this->entityManager->remove($entity);

        if($sync) {
            $this->entityManager->flush();
        }
    }

    public function clear(string $entityName = null): void
    {
        if ($entityName === null) {
            $this->entityManager->clear();
            return;
        }

        $unitOfWork = $this->entityManager->getUnitOfWork();
        $entities = $unitOfWork->getIdentityMap()[$entityName] ?? [];

        foreach ($entities as $entity) {
          $this->entityManager->detach($entity);
        }
    }

    public function enableUserFilter(int $userId): void
    {
        $this->entityManager->getFilters()->enable('user')->setParameter('user_id', $userId);
    }

}