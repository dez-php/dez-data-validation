<?php

namespace Abc;

use Dez\Validation\Rules\Age;
use Dez\Validation\Rules\Email;
use Dez\Validation\Rules\MinMaxString;
use Dez\Validation\Validation;

error_reporting(1); ini_set('display_errors', 1);

include_once '../vendor/autoload.php';

$validation = new Validation($_GET);

$rules  = [

];

$rule   = $validation->add('test2', new Age([
    'message'   => '-- -- -- -- mess 1',
    'min'       => 5,
    'max'       => 32,
]));

$rule->add(new MinMaxString([
    'message'   => '-- mess 1',
    'min'       => 5,
    'max'       => 32,
]))->add(new MinMaxString([
    'message'   => '-- -- mess 1',
    'min'       => 5,
    'max'       => 32,
]))->add(new MinMaxString([
    'message'   => '-- -- -- mess 1',
    'min'       => 5,
    'max'       => 32,
    'returnValue'   => false,
]))->add(new Age([
    'message'   => '-- -- -- -- mess 1',
    'min'       => 5,
    'max'       => 32,
]))->add(new Email([
    'message'   => 'email bad',
    'min'       => 5,
    'max'       => 32,
]))->add(new MinMaxString([
    'message'   => '-- -- -- -- -- -- mess 1',
    'min'       => 5,
    'max'       => 32,
    'returnValue'   => false,
]));

$rule->add(new MinMaxString([
    'message'   => '-- mess 2',
    'min'       => 5,
    'max'       => 32,
]));

$rule->add(new MinMaxString([
    'message'   => 'last check',
    'min'       => 5,
    'max'       => 32,
]));

$validation->validate();

var_dump(
    json_encode($validation->getMessages(), JSON_PRETTY_PRINT)
);
