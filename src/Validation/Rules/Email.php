<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Rule;

    /**
     * Class Email
     * @package Dez\Validation\Rules
     */
    class Email extends Rule {

        /**
         * @return bool
         */
        public function validate()
        {
            return filter_var($this->getValue(), FILTER_VALIDATE_EMAIL);
        }

    }