<?php

namespace App\Classes;


use App\Revenue;

class RevenuesClass
{

    /**
     *
     * Returns a front end friendly array of all revenues in the database.
     *
     * @return array
     */
    public function getAllRevenues() {
        $revenues = Revenue::all();

        return $this->collectionOfRevenuesToOutputArray($revenues->all());
    }

    /**
     *
     * Gets a revenue record from the database and returns a formatted, front end friendly array of
     * the data.
     *
     * @param $revenueId
     * @return array
     */
    public function getRevenueById($revenueId) {

        $revenue = Revenue::find($revenueId);

        if (! $revenue ) {
            abort(404, "Revenue Not Found.\n\n" . __file__ . " @ Line " . __LINE__);
        }

        return $this->aRevenueToArray($revenue);
    }


    /**
     *
     * Loops through a collection of Revenue records, converting each
     * record into a front end friendly array, finally returning
     * that front end friendly array.
     *
     * @param $allRevenues
     * @return array
     */
    private function collectionOfRevenuesToOutputArray($allRevenues) {
        $revenuesOutputArray = [];

        foreach($allRevenues as $aRevenue) {
            $revenuesOutputArray[] = $this->aRevenueToArray($aRevenue);
        }

        return $revenuesOutputArray;

    }

    /**
     *
     * Formats an array that the front end will expect.  The back end data fields
     * can change, as long as the final return array stays the same the front end
     * will just work.
     *
     * @param $aRevenue
     * @return array
     */
    private function aRevenueToArray($aRevenue) {

        $finalOutputArray = [
            'id' => $aRevenue->id,
            'title' => $aRevenue->title
        ];

        return $finalOutputArray;
    }

}