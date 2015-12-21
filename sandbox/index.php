<?php

namespace Abc;

use Dez\Validation\Rules\MinMaxString;
use Dez\Validation\Validation;

include_once '../vendor/autoload.php';

$validation = new Validation($_POST);

$validation

    ->add(new MinMaxString('test', [
        'message'   => 'Bad...',
        'min'       => 5,
        'max'       => 32,
    ]))

;

$validation

    ->add(new MinMaxString('test', [
        'message'   => 'Bad...',
        'min'       => 5,
        'max'       => 32,
    ]))

;


var_dump($validation);
