<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entity\User;
use App\Exception\ValidationException;
use DateTime;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Request as Request;
use Slim\Views\Twig;
use Valitron\Validator;

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


       $v = new Validator($data);

       $v->rule('required', ['name', 'email', 'password', 'confirmPassword']);
       $v->rule('email', 'email');
       $v->rule('equals', 'confirmPassword', 'password')->label('Confirm Password');

       $v->rule(
            function($field, $value, $params, $fields) use ($email) {
      
                $numberOfUsers = $this->entityManager->getRepository(User::class)->count(['email' => $value]);

                return !$numberOfUsers; // will return 'true' if the number is 0 (no users found), and 'false' if the number is 1 (fail-case, when a user already exists with the email).
            }, 'email'
        )->message("User with the given email address already exists.");


       if($v->validate()) {
           echo 'Yay! We are all good!';
       } else {
           throw new ValidationException($v->errors());
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
