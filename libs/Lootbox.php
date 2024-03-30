<?php  // Lootbox.php

class Lootbox {
    // 
    public static function choice($set) {
        // 確率の合計
        $p_total = 0;
        foreach($set as $k => $v) {
            $p_total += $v['probability'];
        }
        //echo "p_total is {$p_total} <br>";
        //　乱数の作成
        $no = random_int(0, ($p_total - 1));

        // 判定
        $probability = 0;
        foreach($set as $k => $v) {
            $probability += $v['probability'];
            //echo "{$k} => {$v["name"]} / {$probability} <br>";
            if ($no < $probability) {
                return $v;
            }
        }
        // ここには来ないはずだが……
        // XXX 後で手直し
        echo "おかしい！！！";
    }
}
