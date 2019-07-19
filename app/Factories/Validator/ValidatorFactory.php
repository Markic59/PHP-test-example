<?php

namespace app\Factories\Validator;

use app\Utils\Translator;
use Illuminate\Validation\Validator;

class ValidatorFactory
{
    /**
     * Get new Validator instance
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return Validator
     */
    public static function make(array $data, array $rules, array $messages = [], array $customAttributes = [] ) {
        return new Validator(new Translator(), $data, $rules, $messages, $customAttributes);
    }

}
