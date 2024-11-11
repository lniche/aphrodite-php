<?php

namespace App\Http\Controllers;

class HealthController extends Controller
{

    public function root()
    {
        return 'Thank you for using Aphrodite!';
    }

    public function ping()
    {
        return $this->ok(message: 'pong');
    }
}
