<?php


class HomeController
{
    const EXEC_COUNT = 10000;   //実行回数
    const TEST_COUNT = 100;     //計測回数
    const DECIMAL_DIGITS = 10;  //小数点桁数

    public function test()
    {
        $all_time = 0.0;                //全体の計測時間
        $num = 0;
        $array = [1, 2, 3, 4, 5, 6, 7, 8];
        for ($i = 0; $i < self::TEST_COUNT; $i++) {
            $start = microtime(true);  //計測前の現在時刻を取得

            for ($j = 0; $j < self::EXEC_COUNT; $j++) {
                /* 10000回実行する内容 */
                if (count($array) > 0) {
                    // 意味のない処理
                    $num++;
                    $temp = self::EXEC_COUNT / self::EXEC_COUNT * $i;
                    $collection = \App\Http\Controllers\collect($array);
                    $request = \App\Http\Controllers\request();
                }

            }
            $end = microtime(true);

            $test_time = $end - $start;
            $all_time += $test_time;
        }
        $average = number_format($all_time / self::TEST_COUNT, self::DECIMAL_DIGITS);
        echo '平均:' . $average . '秒';
    }

    public function triggerViolation(): void
    {
        $x = random_int(0, 100);
        if ($x > 90) {
            echo "high";
        } elseif ($x > 80) {
            echo "80s";
        } elseif ($x > 70) {
            echo "70s";
        } elseif ($x > 60) {
            echo "60s";
        } else {
            echo "low";
        }

        switch ($x % 5) {
            case 0:
                echo "zero";
                break;
            case 1:
                echo "one";
                break;
            case 2:
                echo "two";
                break;
            case 3:
                echo "three";
                break;
            default:
                echo "four";
        }

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                if ($i === $j && $j % 2 === 0) {
                    try {
                        if ($i === 2) {
                            throw new \Exception("Error");
                        }
                    } catch (\Exception $e) {
                        continue;
                    }
                }
            }
        }
    }

    public function dummyWithHighCCN(): void
    {
        for ($i = 0; $i < 3; $i++) {
            if ($i % 2 === 0) {
                echo "even";
            } elseif ($i % 3 === 0) {
                echo "div3";
            } elseif ($i % 5 === 0) {
                echo "div5";
            } else {
                echo "odd";
            }

            switch ($i) {
                case 0:
                    echo "zero";
                    break;
                case 1:
                    echo "one";
                    break;
                case 2:
                    echo "two";
                    break;
                default:
                    echo "default";
            }

            $val = $i > 1 ? ($i % 2 === 0 ? "nested-ternary-yes" : "nested-ternary-no") : "low";
            echo $val;

            try {
                if ($i === 2 && rand(0, 1)) {
                    throw new \RuntimeException("whoops");
                }
            } catch (\RuntimeException $e) {
                echo $e->getMessage();
            }
        }

        if (true && false || true || false && true) {
            echo "unnecessarily complex condition";
        }
    }

    public function dummyWithHighCCN2(): void
    {
        for ($i = 0; $i < 5; $i++) {
            if ($i % 2 === 0) {
                echo "even";
            } elseif ($i % 3 === 0) {
                echo "div3";
            } elseif ($i % 5 === 0) {
                echo "div5";
            } elseif ($i % 7 === 0) {
                echo "div7";
            } elseif ($i % 11 === 0) {
                echo "div11";
            } else {
                echo "prime-ish";
            }

            switch ($i) {
                case 0:
                    echo "zero";
                    break;
                case 1:
                    echo "one";
                    break;
                case 2:
                    echo "two";
                    break;
                case 3:
                    echo "three";
                    break;
                case 4:
                    echo "four";
                    break;
                default:
                    echo "other";
            }

            $val = $i > 1 ? ($i % 2 === 0 ? ($i % 3 === 0 ? "div6" : "div2") : "odd") : "low";
            echo $val;

            try {
                if ($i === 2 && rand(0, 1)) {
                    throw new \RuntimeException("runtime");
                } elseif ($i === 3) {
                    throw new \LogicException("logic");
                } elseif ($i === 4) {
                    throw new \DomainException("domain");
                }
            } catch (\RuntimeException|\LogicException|\DomainException $e) {
                echo $e->getMessage();
            }

            foreach (range(0, 3) as $x) {
                while ($x < 5) {
                    if ($x === 1 || $x === 2 || $x === 3) {
                        continue;
                    } else {
                        break;
                    }
                }
            }

            if (($i > 0 && $i < 5) || ($i % 2 === 0 && $i % 3 === 0) || ($i === 0 || $i > 10)) {
                echo "very complex condition";
            }
        }
    }

    public function dummyWithHighCCN3(): void
    {
        for ($i = 0; $i < 5; $i++) {
            if ($i % 2 === 0) {
                echo "even";
            } elseif ($i % 3 === 0) {
                echo "div3";
            } elseif ($i % 5 === 0) {
                echo "div5";
            } elseif ($i % 7 === 0) {
                echo "div7";
            } elseif ($i % 11 === 0) {
                echo "div11";
            } else {
                echo "prime-ish";
            }

            switch ($i) {
                case 0:
                    echo "zero";
                    break;
                case 1:
                    echo "one";
                    break;
                case 2:
                    echo "two";
                    break;
                case 3:
                    echo "three";
                    break;
                case 4:
                    echo "four";
                    break;
                default:
                    echo "other";
            }

            $val = $i > 1 ? ($i % 2 === 0 ? ($i % 3 === 0 ? "div6" : "div2") : "odd") : "low";
            echo $val;

            try {
                if ($i === 2 && rand(0, 1)) {
                    throw new \RuntimeException("runtime");
                } elseif ($i === 3) {
                    throw new \LogicException("logic");
                } elseif ($i === 4) {
                    throw new \DomainException("domain");
                }
            } catch (\RuntimeException|\LogicException|\DomainException $e) {
                echo $e->getMessage();
            }

            foreach (range(0, 3) as $x) {
                while ($x < 5) {
                    if ($x === 1 || $x === 2 || $x === 3) {
                        continue;
                    } else {
                        break;
                    }
                }
            }

            if (($i > 0 && $i < 5) || ($i % 2 === 0 && $i % 3 === 0) || ($i === 0 || $i > 10)) {
                echo "very complex condition";
            }
        }
    }


}
