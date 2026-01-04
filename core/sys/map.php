<?php

require_once __DIR__ . '/env.php';
require_once __DIR__ . '/stat.php';

function m_x()
{
    $a = e_h() . '|' . e_o();
    $b = e_d();
    $c = substr(s_mm(), 0, 4);

    $raw = $a . '::' . $b . '::' . $c;

    return hash('sha256', $raw);
}
