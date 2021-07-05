<?php

namespace app\controllers;

use app\core\Controller;
use app\core\DB;
use app\core\Request;
use app\models\User;

class UserController extends Controller
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function index()
    {
        return $this->render('users');
    }

    /**
     * Store the user
     * @param Request $request
     * @return false|string
     */
    public function store(Request $request)
    {
        $body = $request->getBody();
        $body['password'] = sha1($body['password']);

        $user = new User($body);

        try {
            $this->db->save($user);
            header('Location: /');
        } catch (\ReflectionException $e) {
            return $e->getMessage();
        }
    }
}