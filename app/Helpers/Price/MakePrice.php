<?php

namespace App\Helpers\Price;

class MakePrice
{
/**
 * Функция преобразует цену в акционную с цифрами в конце 99
 * до сотен 1150 на выходе 1199.
 *
*/
    public static function salePrice($price)
    {
        if ($price == 0) {
            return 0;
        }
        $price_big = (int)($price / 100);
        $price_small = ($price - $price_big * 100);
        if ($price_small > 0) {
            $price_small = 99;
            $newprice = $price_big * 100 + $price_small;
        } else $newprice = $price_big * 100 - 1;
        return $newprice;
    }
}
