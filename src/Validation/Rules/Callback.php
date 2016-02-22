<?php

namespace Dez\Validation\Rules;

use Dez\Validation\Message;
use Dez\Validation\Rule;
use Dez\Validation\Validation;

class Callback extends Rule {

    public function __construct(callable $callback, $message = null)
    {
        $options = [
            'callback'  => $callback,
        ];

        if($message !== null) {
            $options['message'] = $message;
        }

        parent::__construct($options);
    }

    public function validate($field = null, Validation $validation)
    {
        /** @var \Closure $callback */
        $callback = $this->getOption('callback', function(){ });
        $value = $this->getValue($field);

        if(! $callback($value, $this, $validation)) {
            $message    = $this->getOption('message', $this->getDefaultMessage());
            $validation->appendMessage(new Message($field, $message, ['field' => $field]));

            return false;
        }

        return true;
    }

    public function getDefaultMessage()
    {
        return "Failure with validation field :field";
    }

}