<?php  // UserCardsB.php

class UserCardsB {
    //
    public static function insert($card_id, $user_id = null) {
        // user_idを把握
        if (null === $user_id) {
            $user_id = $_SESSION["user_auth"]["user_id"];
        }
var_dump($user_id);

        //　DBハンドルを取得
        $dbh = Db::getHandle();

        /* レコードをupsertする */
        // プリペアドステートメントを作成
        $sql = '
INSERT INTO user_cards_b(card_id, user_id, num, created_at, updated_at)
    VALUES(:card_id, :user_id, 1, :created_at, :updated_at)
ON DUPLICATE KEY UPDATE
    num = num + 1, updated_at = :update_updated_at
;
        ';
        $pre = $dbh->prepare($sql);
        //　値をバインド
        $pre->bindValue(":card_id", $card_id);
        $pre->bindValue(":user_id", $user_id);
        $pre->bindValue(":created_at", date(DATE_ATOM));
        $pre->bindValue(":updated_at", date(DATE_ATOM));
        $pre->bindValue(":update_updated_at", date(DATE_ATOM));
        // SQLを実行
        $r = $pre->execute();
var_dump($r);
    }

    public static function getList($user_id = null) {
        // user_idを把握
        if (null === $user_id) {
            $user_id = $_SESSION["user_auth"]["user_id"];
        }
var_dump($user_id);

        //　DBハンドルを取得
        $dbh = Db::getHandle();

        /* 一覧を取得 */
        // プリペアドステートメントを作成
        $sql = '
SELECT * FROM user_cards_b
 LEFT JOIN cards on cards.card_id = user_cards_b.card_id
 WHERE user_cards_b.user_id = :user_id
 ORDER BY user_cards_b.card_id
;
        ';
        $pre = $dbh->prepare($sql);
        //　値をバインド
        $pre->bindValue(":user_id", $user_id);
        // SQLを実行
        $r = $pre->execute();

        // データを取得
        $data = $pre->fetchAll();

        //
        return $data;
    }

}