<?php

class LogoutController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // réinitialiser  tableau session
        $_SESSION = array();
        session_destroy();

        $this->redirect('/login');
    }
}
