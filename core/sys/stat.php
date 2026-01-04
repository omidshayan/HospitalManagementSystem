<?php

function s_t()
{
    return [
        't' => time(),
        'm' => memory_get_usage(),
        'l' => get_loaded_extensions(),
    ];
}

function s_tm()
{
    return s_t()['t'];
}

function s_mm()
{
    return s_t()['m'];
}
