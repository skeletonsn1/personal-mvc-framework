<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\user\RegisterModel;
use app\validators\UserRegisterValidator;
use app\exceptions\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $registerModel = new RegisterModel();

        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());

            try {
                new UserRegisterValidator($registerModel);
            } catch (ValidationException $exception) {
                var_dump($exception->getValidationMessage());
            }

            //TODO: VALIDATE REGISTER MODEL

            $this->setLayout('main');

            return $this->render('register', [
                'model' => $registerModel
            ]);
        }

        $this->setLayout('proba');

        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
    
    public function login(Request $request)
    {

    }
}