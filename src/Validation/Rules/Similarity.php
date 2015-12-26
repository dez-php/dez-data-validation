<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Message;
    use Dez\Validation\Rule;
    use Dez\Validation\Validation;

    class Similarity extends Rule {

        public function validate($field = null, Validation $validation)
        {
            $value              = $this->getValue($field);
            $comparableField    = $this->getOption('comparable', null);
            $comparable         = $this->getDataCollection()->get($comparableField, null);

            if(null === $comparable || $value !== $comparable) {

                $message        = $this->getOption('message', $this->getDefaultMessage());
                $replacements   = ['field' => $field, 'comparable' => $comparableField];
                $validation->appendMessage(new Message($field, $message, $replacements));

                return false;
            }

            return true;
        }

        public function getDefaultMessage()
        {
            return 'Value :field must be the same as :comparable';
        }

    }