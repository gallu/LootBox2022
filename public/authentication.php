<?php   // authentication.php

$raw_pass = "パスワード";

$ph = password_hash($raw_pass, PASSWORD_DEFAULT, ['cost' => 12]);
var_dump($ph);

$r = password_verify($raw_pass, $ph);
var_dump($r);

$r = password_verify("hoge", $ph);
var_dump($r);

