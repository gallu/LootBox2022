<?php  // draw_lootbox.php

require_once __DIR__ . '/../libs/init.php';
require_once __DIR__ . '/../libs/Lootbox.php';
require_once __DIR__ . '/../libs/UserCardsA.php';
require_once __DIR__ . '/../libs/UserCardsB.php';

/*　がちゃデッキを特定する */
// パラメタを把握する
$deck_id = @strval($_GET["id"] ?? "");
var_dump($deck_id);
// validate
if ("" === $deck_id) {
    header("Location: ./top.php");
    exit;
}
//　デッキマスタにidがあるかどうかを確認する
$dbh = Db::getHandle();
// プリペアドステートメントを作成
$sql = 'SELECT * FROM lootbox_decks WHERE lootbox_deck_id=:id';
$pre = $dbh->prepare($sql);
//　値をバインド
$pre->bindValue(":id", $deck_id);
// SQLを実行
$r = $pre->execute();
// データを取得
$deck = $pre->fetch();
//var_dump($deck);

//ここから（ダメならfalseなのでエラーではねる、から）
if (false === $deck) {
    header("Location: ./top.php");
    exit;
}

//　がちゃを引くためのカードセットを把握する
// プリペアドステートメントを作成
$sql = 'SELECT * FROM lootbox_decks_detail WHERE lootbox_deck_id=:id ORDER BY probability DESC;';
$pre = $dbh->prepare($sql);
//　値をバインド
$pre->bindValue(":id", $deck_id);
// SQLを実行
$r = $pre->execute();
// データを取得
$deck_deail = $pre->fetchAll();
//var_dump($deck_deail);

// がちゃを引く
$card = Lootbox::choice($deck_deail);
var_dump($card);

//　引いたカードをuser_cardsテーブルに入れる
//UserCardsA::insert($card_id, $user_id);
UserCardsA::insert($card["card_id"]);
UserCardsB::insert($card["card_id"]);

//　引いたカードを表示する

