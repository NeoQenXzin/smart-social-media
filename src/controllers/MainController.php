<?php


class MainController extends Controller
{
    public function index()
    {
        require_once __DIR__ . '/../Views/Header.php';
        include __DIR__ . '/../Views/Home.php';
    }
}
