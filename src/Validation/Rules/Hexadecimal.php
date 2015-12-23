<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Message;
    use Dez\Validation\Rule;
    use Dez\Validation\Validation;

    /**
     * Class Hexadecimal
     * @package Dez\Validation\Rules
     */
    class Hexadecimal extends Rule {

        /**
         * @param null $field
         * @param Validation $validation
         * @return bool
         */
        public function validate($field = null, Validation $validation)
        {
            $value  = $this->getValue($field);

            if(! ctype_xdigit($value)) {
                $message    = $this->getOption('message', $this->getDefaultMessage());
                $validation->appendMessage(new Message($field, $message, $this->getOptions() + ['field' => $field]));

                return false;
            }

            return true;
        }

        /**
         * @return string
         */
        public function getDefaultMessage()
        {
            return 'Value of \':field\' must be hexadecimal.';
        }

    }