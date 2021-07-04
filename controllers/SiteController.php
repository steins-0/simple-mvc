<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return $this->render('home', [
            'name' => 'Mike'
        ]);
    }
}