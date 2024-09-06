<?php declare(strict_types=1);

namespace App;

use App\Contracts\SessionInterface;

class Session implements SessionInterface
{
    public function start(): void
    {
        session_set_cookie_params(['secure' => true, 'httponly' => true, 'samesite' => 'lax']);

        session_start();
    }

    public function save(): void
    {
        session_write_close();
    }
}
