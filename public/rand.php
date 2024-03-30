<?php  // rand.php
//  https://dev2.m-fr.net/アカウント名/LootBox/rand.php
$uuid = trim(`uuidgen -r`);
var_dump($uuid);

echo "<br>";

$id = bin2hex(random_bytes(24));
var_dump($id);

// ダメなやり方を後で追記する
$id = md5(uniqid(rand(),true));
var_dump($id);
// その２
$id = sha1(uniqid(mt_rand(),true));
var_dump($id);

