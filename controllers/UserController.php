<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class UserController extends Controller
{
    public function index()
    {
        return $this->render('users');
    }

    public function store(Request $request)
    {
        var_dump($request->getBody());
    }
}