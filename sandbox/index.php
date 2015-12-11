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

$rule   = $validation


    ->add(new MinMaxString('test', [
    'message'   => 'Bad...',
    'min'       => 5,
    'max'       => 32,
]))
    ->add(new MinMaxString('test', [
    'message'   => 'Bad...',
    'min'       => 5,
    'max'       => 32,
]))
    ->add(new MinMaxString('test', [
    'message'   => 'Depth 2',
    'min'       => 5,
    'max'       => 32,
]))
    ->add(new MinMaxString('test', [
    'message'   => '123123123aasd asd as dasd.',
    'min'       => 5,
    'max'       => 32,
]));


$validation

    ->add(new MinMaxString('test', [
        'message'   => 'Bad...',
        'min'       => 5,
        'max'       => 32,
    ]))

;


var_dump($validation);
