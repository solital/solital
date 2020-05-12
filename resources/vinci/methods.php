<?php

use Vinci\Vinci as Vinci;

$variable = false;

if (isset($_GET['btnController'])) {
    $variable = Vinci::Controller(filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_SPECIAL_CHARS));
}

if (isset($_GET['btnView'])) {
    $variable = Vinci::View(filter_input(INPUT_GET, 'view', FILTER_SANITIZE_SPECIAL_CHARS));
}

if (isset($_GET['btnModel'])) {
    $variable = Vinci::Model(filter_input(INPUT_GET, 'model', FILTER_SANITIZE_SPECIAL_CHARS));
}

if (isset($_GET['btnDump'])) {
    $variable = Vinci::Dump(filter_input(INPUT_GET, 'dump', FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_GET, 'dump-local', FILTER_SANITIZE_SPECIAL_CHARS));
}

?>
