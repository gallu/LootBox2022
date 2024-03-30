<?php  // card_list.php
require_once __DIR__ . '/../libs/init.php';
require_once __DIR__ . '/../libs/UserCardsB.php';

// カード一覧の取得
$card_list = UserCardsB::getList();
var_dump($card_list);

//　表示
// (略)