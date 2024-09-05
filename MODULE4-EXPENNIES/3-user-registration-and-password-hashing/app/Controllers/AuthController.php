<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Request as Request;
use Slim\Views\Twig;

class AuthController
{

    public function __construct(private readonly Twig $twig, private readonly User $user, private readonly EntityManager $entityManager) {}

    public function loginView(Request $request, Response $response): Response
    {


        return $this->twig->render($response, 'auth/login.twig');
    }



    public function registerView(Request $request, Response $response): Response
    {


        return $this->twig->render($response, 'auth/register.twig');
    }



    public function register(Request $request, Response $response): Response
    {

       $data = $request->getParsedBody();


       [
       'name' => $name, 
       'email' => $email, 
       'password' => $password, 
       'confirmPassword' => $confirmPassword
        ] = $data;

       if ($password !== $confirmPassword) {
           return $this->twig->render($response, 'auth/register.twig');
       }

       $user = new User();

       $user->setName($name);
       $user->setEmail($email);
       $user->setHashedPassword($password);
    //    $user->setCreatedAt(new \DateTime()); // This is now set by the 'onPrePersist' method, of the lifecycle callbacks..
    //    $user->setUpdatedAt(new \DateTime());

       
       $this->entityManager->persist($user);
       $this->entityManager->flush();
       
       var_dump($data, 'THE DATA');

        return $response;
    }
}
