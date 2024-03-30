<?php  // index.php

$no_auth = true; // 認可チェックをしない
require_once __DIR__ . '/../libs/init.php';

//
//var_dump($_SESSION);
$flash = $_SESSION["flash"] ?? [];
unset($_SESSION["flash"]);

$context = [
    "flash" => $flash,
];
$template_filename = "index.twig";

require_once __DIR__ . '/../libs/fin.php';
