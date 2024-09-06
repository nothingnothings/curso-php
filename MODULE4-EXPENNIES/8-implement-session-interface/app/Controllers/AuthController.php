<?php declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\AuthInterface;
use App\Entity\User;
use App\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Request as Request;
use Slim\Views\Twig;
use Valitron\Validator;
use DateTime;

// class AuthController
// {

//     public function __construct(private readonly Twig $twig, private readonly User $user, private readonly EntityManager $entityManager) {}

//     public function loginView(Request $request, Response $response): Response
//     {

//         return $this->twig->render($response, 'auth/login.twig');
//     }

//     public function registerView(Request $request, Response $response): Response
//     {

//         return $this->twig->render($response, 'auth/register.twig');
//     }

//     public function register(Request $request, Response $response): Response
//     {

//        $data = $request->getParsedBody();

//        [
//        'name' => $name,
//        'email' => $email,
//        'password' => $password,
//        'confirmPassword' => $confirmPassword
//         ] = $data;

//        $v = new Validator($data);

//        $v->rule('required', ['name', 'email', 'password', 'confirmPassword']);
//        $v->rule('email', 'email');
//        $v->rule('equals', 'confirmPassword', 'password')->label('Confirm Password');

//        $v->rule(
//             function($field, $value, $params, $fields) use ($email) {

//                 $numberOfUsers = $this->entityManager->getRepository(User::class)->count(['email' => $value]);

//                 return !$numberOfUsers; // will return 'true' if the number is 0 (no users found), and 'false' if the number is 1 (fail-case, when a user already exists with the email).
//             }, 'email'
//         )->message("User with the given email address already exists.");

//         if(!$v->validate()) {
//             throw new ValidationException($v->errors());
//         }

//        $user = new User();

//        $user->setName($name);
//        $user->setEmail($email);
//        $user->setHashedPassword($password);

//        $this->entityManager->persist($user);
//        $this->entityManager->flush();

//        var_dump($data, 'THE DATA');

//         return $response;
//     }

//     public function logIn(Request $request, Response $response): Response
//     {
//         // 1. Validate the request data  // * DONE

//         $data = $request->getParsedBody();
//         ['email' => $email, 'password' => $password ] = $data;

//         $v = new Validator($data);

//         $v->rule('required', ['email', 'password']);
//         $v->rule('email', 'email');

//         // 2. Check the user credentials // * DONE
//         if(!$v->validate()) {
//             echo 'Entered';
//             var_dump($v->errors());
//             throw new ValidationException($v->errors());
//         }

//         // 2.1 Find the user by email // * DONE
//         $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

//         // 2.2 Check if the user exists  // * DONE
//         if(!$user || !password_verify($data['password'], $user->getPassword())) {
//             throw new ValidationException(['password' => ['You have entered an invalid username or password.']]);
//         }

//         // 2.3 Regenerate the user's sessionid, to improve security and defend against session hijacking attacks. // * DONE
//         session_regenerate_id(true);

//         // 3. Save user id in the session // * DONE
//         $_SESSION['user'] = $user->getId();

//         // 4. Redirect user to the home page // * DONE
//         return $response->withHeader('Location', '/')->withStatus(302);
//     }

//     public function logOut(Request $request, Response $response): Response
//     {
//         return $response->withHeader('Location', '/')->withStatus(302);
//     }
// }



class AuthController
{

    public function __construct(private readonly Twig $twig,  private readonly AuthInterface $auth) {}

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


        if(!$v->validate()) {
            throw new ValidationException($v->errors());
        } 
       
       $user = new User();

       $user->setName($name);
       $user->setEmail($email);
       $user->setHashedPassword($password);

       $this->entityManager->persist($user);
       $this->entityManager->flush();
       
       var_dump($data, 'THE DATA');

        return $response;
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
