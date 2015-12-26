<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Message;
    use Dez\Validation\Rule;
    use Dez\Validation\Validation;

    /**
     * Class Identical
     * @package Dez\Validation\Rules
     */
    class Identical extends Rule {

        /**
         * @param null $field
         * @param Validation $validation
         * @return bool
         */
        public function validate($field = null, Validation $validation)
        {
            $value      = $this->getValue($field);
            $accepted   = $this->getOption('accepted', null);

            if($value !== $accepted) {

                $message        = $this->getOption('message', $this->getDefaultMessage());
                $replacements   = $this->getOptions() + ['field' => $field, 'accepted' => $accepted];
                $validation->appendMessage(new Message($field, $message, $replacements));

                return false;
            }

            return true;
        }

        /**
         * @return string
         */
        public function getDefaultMessage()
        {
            return 'Value length of :field must be identical for \':accepted\'';
        }

    }