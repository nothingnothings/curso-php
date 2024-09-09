<?php declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\AuthInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\DTOs\UserData;
use App\Exception\ValidationException;
use App\Factories\ValidatorFactory;
use App\RequestValidators\RegisterUserRequestValidator;
use App\RequestValidators\UserLoginRequestValidator;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Request as Request;
use Slim\Views\Twig;


class AuthController
{

    public function __construct(
        private readonly Twig $twig,  
        private readonly AuthInterface $auth, 
        private readonly EntityManager $entityManager, 
        private readonly ValidatorFactory $requestValidatorFactory) {}

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
        $parsedBody = $request->getParsedBody();


        $data = $this->requestValidatorFactory
                    ->make(RegisterUserRequestValidator::class)
                    ->validate($parsedBody);

        $this->auth->register($userData);
    
        return $response->withHeader('Location', '/')->withStatus(302);
    }


    public function logIn(Request $request, Response $response): Response
    {
        // 1. Validate the request data and check the user's credentials  // * DONE 
        
        $rawData = $request->getParsedBody();

        var_dump($rawData);

        $userData = new UserData($rawData['email'], $rawData['password']);

        $data = $this->requestValidatorFactory->make(UserLoginRequestValidator::class)->validate($userData);
            
        if (!$this->auth->attemptLogin($data)) {
            throw new ValidationException(['password' => ['You have entered an invalid username or password.']]);
        }

        // 2. Redirect user to the home page // * DONE  
        return $response->withHeader('Location', '/')->withStatus(302); 
    }


    public function logOut(Request $request, Response $response): Response
    {
        $this->auth->logout();

        return $response->withHeader('Location', '/')->withStatus(302);
    }
}
