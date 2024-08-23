<?php declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Models\Email;
use App\View;
use Symfony\Component\Mime\Address;

class UserController
{
    #[Get('/users/create')]
    public function create(): View
    {
        return View::make('users/register');
    }

    #[Post('/users')]
    public function register()
    {
        $firstName = $_POST['name'];
        $emailAddress = new Address($_POST['email']);

        $text = <<<Body

                    Hello $firstName,

                    Thank you for registering with us. We will be in touch with you shortly.

                    Best Regards,

                    Your Company
            Body;

        $html = <<<Body
                    <h1 style="text-align: center; color: blue;">Welcome</h1>
                    Hello $firstName,
                    <br /
                    Thank you for registering with us. We will be in touch with you shortly.

                    Best Regards,

                    Your Company
            Body;

        // * Now we queue the email (create record in database), instead of immediately sending it:
        (new Email())->queue(
            $emailAddress,
            new Address('support@example.com', 'Support'),
            'Welcome!',
            $html,
            $text
        );

        // $this->mailer->send($email);
    }
}
