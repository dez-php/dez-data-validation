<?php

    namespace Dez\Validation\Rules;

    use Dez\Validation\Rule;

    class MinMaxString extends Rule {

        public function validate($value)
        {
            echo $this->getField() . ' => ' . $this->getMessage()->getMessage() . "<br>\n";
            return (bool) rand(0, 1);
        }

    }