<?php

namespace app\controllers;

use app\core\Controller;
use app\core\DB;

class SiteController extends Controller
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function index()
    {
        $users = $this->db->get('users');

        return $this->render('home', [
            'users' => $users
        ]);
    }
}