<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'username' => 'sKeletoN'
        ];

        return $this->render('home', $params);
    }

    public function contact()
    {
        $this->setLayout('proba');

        return $this->render('contact');
    }
    
    public function handleContact(Request $request)
    {
        return 'Submit forum functionality triggered.';
    }
}