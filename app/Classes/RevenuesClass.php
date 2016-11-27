<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 11/23/16
 * Time: 12:25 PM
 */

namespace App\Classes;


use App\Revenue;

class RevenuesClass
{

    private $allRevenues = [
        "1" => '< $1 Million',
        "2" => '$1 - $1.5 Million',
        "3" => '$1.5 - $2 Million',
        "4" => '$2 - $2.5 Million',
        "5" => '> $2.5 Million'
    ];


    public function getAllRevenues() {
        $revenues = Revenue::all();

        return $this->collectionOfRevenuesToOutputArray($revenues->all());
    }

    public function getRevenueById($revenueId) {

        $revenue = Revenue::find($revenueId);

        if (! $revenue ) {
            abort(404, "Revenue Not Found.\n\n" . __file__ . " @ Line " . __LINE__);
        }

        return $this->aRevenueToArray($revenue);
    }


    private function collectionOfRevenuesToOutputArray($allRevenues) {
        $revenuesOutputArray = [];

        foreach($allRevenues as $aRevenue) {
            $revenuesOutputArray[] = $this->aRevenueToArray($aRevenue);
        }

        return $revenuesOutputArray;

    }

    private function aRevenueToArray($aRevenue) {

        $finalOutputArray = [
            'id' => $aRevenue->id,
            'title' => $aRevenue->title
        ];

        return $finalOutputArray;
    }

}