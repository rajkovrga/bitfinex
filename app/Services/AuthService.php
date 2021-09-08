<?php

namespace App\Services;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Session;

class AuthService
{

    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function login()
    {
        if($this->session->has('isLogin'))
            throw new AuthenticationException();

        $this->session->push('isLogin', true);

    }

    public function logout()
    {
        $this->session->remove('isLogin');
        $this->session->flush();
    }
}
