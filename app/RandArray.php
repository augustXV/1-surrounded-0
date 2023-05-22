<?php

namespace app;

class RandArray
{
    private int $rowLength;
    private int $numOfRows;

    public function __construct($rowLength, $numOfRows)
    {
        $this->rowLength = $rowLength;
        $this->numOfRows = $numOfRows;

        if ($this->rowLength == 0 || $this->numOfRows == 0) {
            die("Only > 0");
        }
    }


    private function fillRow($array): array
    {
        for ($row = 0; $row < $this->rowLength; $row++) {
            $array[$row] = rand(0, 1);
            //echo $array[$row]; // Для просмотра неотфильтрованного массива
            if ($array[$row] == 1 && $row != 0) {
                $array[$row - 1] == 1 ? $array[$row] = 0 : $array[$row - 1] = 0;
            }
            //echo $array[$row]; // После фильтра
        }

        return $array;
    }


    public function buildMatrix($array): array
    {
        for ($i = 0; $i < $this->numOfRows; $i++) {
            $array[$i] = self::fillRow($array);
            if ($i > 0) $array[$i] = self::more0($array[$i], self::takeKeys($array[$i - 1]));
            for ($j = 0; $j < count($array[$i]); $j++) {
                echo $array[$i][$j];
            }
            echo PHP_EOL;
            //print_r($array[$i]);
        }
        return $array;
    }

    public function takeKeys($array): array
    {
        $keys = [];
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] == 1) {
                $keys[] = $i;
            }
        }
        return $keys;
    }


    public function more0($array, $modify): array
    {
        $elemNum = 0;
        for ($i = 0; $i < count($array); $i++) {
            if ($elemNum < count($modify) && $i == $modify[$elemNum]) {
                $array[$i] = 0;
                if ($modify[$elemNum] > 0 && $modify[$elemNum] < array_key_last($array)) {
                    $array[$i - 1] = 0;
                    $array[$i + 1] = 0;
                }
                if ($modify[$elemNum] == 0) $array[$i + 1] = 0;
                if ($modify[$elemNum] == array_key_last($array)) $array[$i - 1] = 0;
                $elemNum++;
            }
        }
        return $array;
    }

}