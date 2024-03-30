<?php  // UserCardsA

class UserCardsA {
    //
    public static function insert($card_id, $user_id = null) {
        // user_idを把握
        if (null === $user_id) {
            $user_id = $_SESSION["user_auth"]["user_id"];
        }
var_dump($user_id);

        //　DBハンドルを取得
        $dbh = Db::getHandle();

        /* レコードをinsertする */
        // プリペアドステートメントを作成
        $sql = 'INSERT INTO user_cards_a(card_id, user_id, created_at) VALUES(:card_id, :user_id, :created_at);';
        $pre = $dbh->prepare($sql);
        //　値をバインド
        $pre->bindValue(":card_id", $card_id);
        $pre->bindValue(":user_id", $user_id);
        $pre->bindValue(":created_at", date(DATE_ATOM));

        // SQLを実行
        $r = $pre->execute();
var_dump($r);
    }
}