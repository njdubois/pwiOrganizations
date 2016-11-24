<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 11/23/16
 * Time: 12:24 PM
 */

namespace App\Classes;


class CausesClass
{

    public function getAllCauses() {
        return [
            '1' => 'Water',
            '2' => 'Animals',
            '3' => 'Health',
            '4' => 'Care',
            '5' => 'Joy',
            '6' => 'Sun'
        ];
    }
}