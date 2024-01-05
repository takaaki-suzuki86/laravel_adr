<?php


namespace App\Http\Controllers;


class HomeController
{
    const EXEC_COUNT = 10000;   //実行回数
    const TEST_COUNT = 100;     //計測回数
    const DECIMAL_DIGITS = 10;  //小数点桁数

    public function test()
    {
        $all_time = 0.0;                //全体の計測時間
        $num = 0;
        $array = [1,2,3,4,5,6,7,8];
        for($i = 0; $i < self::TEST_COUNT; $i++) {
            $start = microtime(true);  //計測前の現在時刻を取得

            for($j = 0; $j < self::EXEC_COUNT; $j++) {
                /* 10000回実行する内容 */
                if(count($array) > 0){
                    // 意味のない処理
                    $num++;
                    $temp = self::EXEC_COUNT / self::EXEC_COUNT * $i;
                    $collection = collect($array);
                    $request = request();
                }

            }
            $end = microtime(true);

            $test_time = $end - $start;
            $all_time += $test_time;
        }
        echo "\n";
        $average = number_format($all_time / self::TEST_COUNT, self::DECIMAL_DIGITS);
        echo '平均:'.$average.'秒';
    }
}
