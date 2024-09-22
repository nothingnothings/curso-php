<?php declare(strict_types=1);

namespace App\Filters;

use App\Contracts\OwnableInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class UserFilter extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        // ? Ex: ''category WHERE user_id = 1 '' --> this gets added to your queries, in the WHERE clause.
        // return $targetTableAlias . '.user_id = ' . $this->getParameter('user_id');

        // * If class implements OwnableInterface (in other words, the entity has the user_id field), then add the WHERE clause to the SQL query:
        if ($targetEntity->getReflectionClass()->implementsInterface(OwnableInterface::class)) {
            $userId = $this->getParameter('user_id');

            return $targetTableAlias . '.user_id = ' . $userId;
        } else {
            return '';
        }
    }
}
