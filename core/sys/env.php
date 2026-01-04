<?php

function _e()
{
    return [
        'h' => gethostname(),
        'o' => php_uname(),
        'p' => PHP_VERSION,
        'd' => realpath(__DIR__ . '/../../'),
    ];
}

function e_h()
{
    return _e()['h'];
}

function e_o()
{
    return _e()['o'];
}

function e_p()
{
    return _e()['p'];
}

function e_d()
{
    return _e()['d'];
}
