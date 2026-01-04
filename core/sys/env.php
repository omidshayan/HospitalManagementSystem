<?php

function env_data()
{
    return [
        'h' => gethostname(),
        'o' => php_uname(),
        'p' => PHP_VERSION,
        'd' => realpath(__DIR__ . '/../../'),
    ];
}
