<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Message;
    use Dez\Validation\Rule;
    use Dez\Validation\Validation;

    /**
     * Class Email
     * @package Dez\Validation\Rules
     */
    class Email extends Rule {

        /**
         * @param null $field
         * @param Validation $validation
         * @return bool
         */
        public function validate($field = null, Validation $validation)
        {
            $value      = $this->getValue($field);

            if(! filter_var($value, FILTER_VALIDATE_EMAIL)) {

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
            return 'Value of :field is not a valid email address';
        }

    }