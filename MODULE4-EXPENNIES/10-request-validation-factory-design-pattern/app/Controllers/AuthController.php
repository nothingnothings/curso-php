<?php declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\AuthInterface;
use App\DTOs\UserData;
use App\Entity\User;
use App\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Request as Request;
use Slim\Views\Twig;
use Valitron\Validator;


class AuthController
{

    public function __construct(private readonly Twig $twig,  private readonly AuthInterface $auth, private readonly EntityManager $entityManager) {}

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

        $userData = new UserData($name, $email, $password);


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


        if(!$v->validate()) {
            throw new ValidationException($v->errors());
        } 
       
       $this->auth->register($userData);
    
        return $response->withHeader('Location', '/')->withStatus(302);
    }


    public function logIn(Request $request, Response $response): Response
    {
        // 1. Validate the request data  // * DONE  

        $data = $request->getParsedBody();
        ['email' => $email, 'password' => $password ] = $data;
     
        $v = new Validator($data);

        $v->rule('required', ['email', 'password']);
        $v->rule('email', 'email');


        // 2. Check the user credentials // * DONE  
        if(!$v->validate()) {
            echo 'Entered';
            var_dump($v->errors());
            throw new ValidationException($v->errors());
        } 

        if($this->auth->attemptLogin($data)) {
            throw new ValidationException(['password' => ['You have entered an invalid username or password.']]);
        }

        // 4. Redirect user to the home page // * DONE  
        return $response->withHeader('Location', '/')->withStatus(302); 
    }


    public function logOut(Request $request, Response $response): Response
    {
        $this->auth->logout();


        return $response->withHeader('Location', '/')->withStatus(302);
    }
}
