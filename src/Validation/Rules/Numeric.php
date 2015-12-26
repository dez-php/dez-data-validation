<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Message;
    use Dez\Validation\Rule;
    use Dez\Validation\Validation;


    class Numeric extends Rule {

        public function validate($field = null, Validation $validation)
        {
            if(! is_numeric($this->getValue($field))) {
                $message    = $this->getOption('message', $this->getDefaultMessage());
                $validation->appendMessage(new Message($field, $message, $this->getOptions() + ['field' => $field]));

                return false;
            }

            return true;
        }

        public function getDefaultMessage()
        {
            return 'Value of \':field\' must be numeric.';
        }

    }