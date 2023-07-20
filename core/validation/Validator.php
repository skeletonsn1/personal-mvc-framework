<?php

namespace app\core\validation;

use app\core\Application;
use app\exceptions\ValidationException;

abstract class Validator extends Rules
{
    private array $errors = [];

    public function __construct($data)
    {
        $this->rules();
        $this->validate($data);
    }

    private function validate($data)
    {        
        Application::$APP->translator->translate('validator', 'f0rest', ['asdfwa', 'dawfawwwf']); die;

        foreach ($this->rules as $fieldName => $fieldRules) {
            foreach ($fieldRules as $ruleName => $ruleValue) {
                if (is_array($data)) {
                    $data = (object) $data;
                }

                switch ($ruleName) {
                    case self::RULE_REQUIRED:
                        if (property_exists($data, $fieldName) === false || !$data->$fieldName) {
                            $this->addError($fieldName, 'Field ' . $fieldName . ' is required.');
                        }
                        break;
                    case self::RULE_EMAIL:
                        if (!filter_var($data->$fieldName, FILTER_VALIDATE_EMAIL)) {
                            $this->addError($fieldName, 'Email validation failed.');
                        }
                        break;
                    case self::RULE_MIN:
                        if (strlen($data->$fieldName) < $ruleValue) {
                            $this->addError($fieldName, 'Minimum length of this value should be ' . $ruleValue);
                        }
                        break;
                    case self::RULE_MAX:
                        if (strlen($data->$fieldName) > $ruleValue) {
                            $this->addError($fieldName, 'Maximum length of this value should be ' . $ruleValue);
                        }
                        break;
                    case self::RULE_MATCH:
                        if ($data->$ruleValue !== $data->$fieldName) {
                            $this->addError($fieldName, 'Field ' . $fieldName . ' must match with ' . $ruleValue);
                        }
                        break;
                    case self::RULE_UNIQUE:
                        break;
                }
            }
        }

        if (!empty($this->errors)) {
            $validationException = new ValidationException();
            $validationException->setValidationMessage($this->errors);
            throw $validationException;
        }
    }

    private function addError(string $fieldName, string $message)
    {
        $this->errors[$fieldName][] = $message;
    }

    abstract function rules();
}
