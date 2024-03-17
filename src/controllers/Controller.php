<?php
//Classe parent de tous les autres controller
abstract class Controller
{
    //On permet la redirection vers une autre page (donnée en paramètre)
    public function redirect($path)
    {
        header("Location:$path");
        exit();
    }
    //On oblige tous les controller à implémenter la fonction index(), vu qu'elle est demandée dans le Router
    abstract public function index();
}
