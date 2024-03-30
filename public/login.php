<?php  // login.php
//
ob_start();
session_start();

require_once(__DIR__ . "/../libs/Db.php");

//　入力データの取得
$id = @strval($_POST["id"]  ??  "");
$pw = @strval($_POST["pw"]  ??  "");
var_dump($id, $pw);

// validate
if (("" === $id)or("" === $pw)) {
    // エラーだよ、って情報を渡してあげる
    $_SESSION["flash"]["login_error"] = true;
    $_SESSION["flash"]["login_id"] = $id;
    // index.phpに遷移させる
    header("Location: ./index.php");
    // エラーメッセージ等
    exit;
}

try {
    // DBからhashedなパスワードを取得
    $dbh = Db::getHandle();
    var_dump($dbh);
    // プリペアドステートメントを作成
    $sql = 'SELECT * FROM users WHERE user_id = :user_id;';
    $pre = $dbh->prepare($sql);
    // 値をバインド
    $pre->bindValue(":user_id", $id);
    // SQLを実行
    $r = $pre->execute();
    var_dump($r);
    //
    $user = $pre->fetch();
    var_dump($user);
    // ユーザIDがなければNG
    if (false === $user) {
        throw new \Exception();
    }

    // パスワードの比較
    if (false === password_verify($pw, $user["password"])) {
        throw new \Exception();
    }
} catch(PDOException $e) {
    // XXX 本来はかかない
    echo $e->getMessage();
    exit;
} catch(Exception $e) {
    // エラーだよ、って情報を渡してあげる
    $_SESSION["flash"]["login_error"] = true;
    $_SESSION["flash"]["login_id"] = $id;
    // index.phpに遷移させる
    header("Location: ./index.php");
    // エラーメッセージ等
    exit;
}

//　OKだったら
//　認可処理
session_regenerate_id(true); // セキュリティ対策
//
unset($user["password"]);
$_SESSION["user_auth"] = $user;

//
header("Location: ./top.php");
