<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Rule;

    class MinMaxString extends Rule {

        public function validate($field, $value)
        {
            return true;
        }

    }