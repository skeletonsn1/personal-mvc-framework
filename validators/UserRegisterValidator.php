<?php

namespace app\validators;

use app\core\validation\Validator;

class UserRegisterValidator extends Validator
{
    public function rules()
    {
        $this->field('firstName')->isRequired()->isEmail()->min(3)->max(6)->match('lastName');
    }
}
