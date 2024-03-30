<?php  // init.php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Db.php';

//
ob_start();
session_start();

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

//　認可チェック
if ((false === isset($no_auth))||(false === $no_auth)) {
    if (false === isset($_SESSION["user_auth"])) {
        header("Location: index.php");
        exit;
    }
}