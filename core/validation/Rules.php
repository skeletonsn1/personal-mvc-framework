<?php

namespace app\core\validation;

abstract class Rules
{
    const RULE_REQUIRED = 'required';
    const RULE_EMAIL    = 'email';
    const RULE_MIN      = 'min';
    const RULE_MAX      = 'max';
    const RULE_UNIQUE   = 'unique';
    const RULE_MATCH    = 'match';

    public $rules = [];

    public function field(string $field)
    {
        $this->rules[$field] = [];
        end($this->rules);

        return $this;
    }

    public function isRequired()
    {
        $this->rules[key($this->rules)][self::RULE_REQUIRED] = true;

        return $this;
    }

    public function isEmail()
    {
        $this->rules[key($this->rules)][self::RULE_EMAIL] = true;

        return $this;
    }

    public function min($value)
    {
        $this->rules[key($this->rules)][self::RULE_MIN] = $value;
        
        return $this;
    }

    public function max($value)
    {
        $this->rules[key($this->rules)][self::RULE_MAX] = $value;

        return $this;
    }

    public function isUnique()
    {
        $this->rules[key($this->rules)][self::RULE_UNIQUE] = true;

        return $this;
    }

    public function match($value)
    {
        $this->rules[key($this->rules)][self::RULE_MATCH] = $value;

        return $this;
    }
}
