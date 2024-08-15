<?php

declare(strict_types=1);

namespace App;


use App\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;
use App\Exceptions\Container\NotFoundException;
use ReflectionClass;

class Container implements ContainerInterface
{
    private array $entries = [];


    // ! Without autowiring:
    // public function get(string $id)
    // {

    //     if (!$this->has($id)) {
    //         throw new NotFoundException('Class ' . $id . ' not found');
    //     }

    //     $entry = $this->entries[$id];

    //     return $entry($this);
    // }

    // * With autowiring:
    public function get(string $id)
    {
        echo 'EXECUTED   ';
        echo $id;
        echo '<br />';


        // * If there is an explicit entry/binding for the given class, we use it:
        if ($this->has($id)) {
            $entry = $this->entries[$id];


            // if it is callable (like a closure), we call it:
            if (is_callable($entry)) {
                return $entry($this);
            }

            echo 'CLASS ';

            // TODO Interfaces lesson:
            // If it is not callable (like a interface identifier, fully qualified class name), we use it as is:
            $id = $entry;
        }

        // * If there is no explicit entry/binding for the given class, we try to resolve it (the autowiring itself, via a custom method):
        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }


    public function set(string $id, callable|string $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {
        echo 'EXECUTED-2 ';
        // * 1. We need to inspect the class that we are trying to get from the container (using reflection api):

        $reflectionClass = new ReflectionClass($id);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException('Class ' . $id . ' is not instantiable');
        }

        // * 2. We need to inspect the constructor of the class 
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            // If there is no constructor, we can just return a new instance of the class, without any dependencies/arguments.
            return new $id();
        }

        // * 3. We need to inspect the constructor's parameters (dependencies)
        $constructorParameters = $constructor->getParameters();

        if (count($constructorParameters) === 0) {
            return new $id();
        }

        // * 4. If the constructor parameter is a class, then we need to try and resolve that class, using the container as a param...
        $dependencies = array_map(function (\ReflectionParameter $parameter) use ($id) {

            // Get the parameter name and type, store them in variables:
            $parameterName = $parameter->getName();
            $parameterType = $parameter->getType();

            if (!$parameterType) {
                throw new ContainerException('Failed to resolve class' . $id . ' because parameter ' . $parameterName . ' is missing a typehint');
            }

            // IF the parameter has a typehint of union type, we throw an exception
            if ($parameterType instanceof \ReflectionUnionType) {
                throw new ContainerException('Failed to resolve class' . $id . ' because parameter ' . $parameterName . ' uses union types');
            }

            if ($parameterType instanceof \ReflectionNamedType && !$parameterType->isBuiltin()) {

                return $this->get($parameterType->getName());
            }

            throw new ContainerException('Failed to resolve class' . $id . ' because of invalid parameter' . $parameterName);


        }, $constructorParameters);


        // * 5. We can now create a new instance of the class, using the resolved dependencies:
        return $reflectionClass->newInstanceArgs($dependencies);


    }


}
