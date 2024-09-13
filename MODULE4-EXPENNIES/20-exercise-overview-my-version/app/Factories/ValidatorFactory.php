<?php declare(strict_types=1);

namespace App\Factories;

use App\Contracts\RequestValidatorInterface;
use App\RequestValidators\RegisterUserRequestValidator;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ValidatorFactory
{

    public function __construct(private readonly ContainerInterface $container) {}

    public function make(string $class): RequestValidatorInterface
    {

        $validator = $this->container->get($class);

        if ($validator instanceof RequestValidatorInterface) {
            return $validator;
        }

        throw new \RuntimeException('Failed to instantiate the request validator class: ' . $class );  

    }
}
