<?php  // twig_test.php
//  php  twig_test.php
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\ArrayLoader([
    'index' => 'Hello {{ name }}!',
    'hoge' => 'へろー {{ name }}!',
]);
$twig = new \Twig\Environment($loader);

echo $twig->render('hoge', ['name' => 'おいちゃん']);
echo "\n";