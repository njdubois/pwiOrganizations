<?php


namespace App\Classes;


use App\Cause;

class CausesClass
{

    /**
     *
     * Gets a front end friendly array of all causes in the database.
     *
     * @return array
     */
    public function getAllCauses() {
        $causes = Cause::all();

        return $this->collectionOfCausesToOutputArray($causes->all());
    }

    /**
     *
     * Loops through a collection of Cause records, converting each
     * record into a front end friendly array, finally returning
     * that front end friendly array.
     *
     * @param $allCauses
     * @return array
     */
    private function collectionOfCausesToOutputArray($allCauses) {
        $causesOutputArray = [];

        foreach($allCauses as $aCause) {
            $causesOutputArray[] = $this->aCauseToArray($aCause);
        }

        return $causesOutputArray;

    }

    /**
     *
     * Formats an array that the front end will expect.  The back end data fields
     * can change, as long as the final return array stays the same the front end
     * will just work.
     *
     * @param $aCause
     * @return array
     */
    private function aCauseToArray($aCause) {

        $finalOutputArray = [
            'id' => $aCause->id,
            'title' => $aCause->title
        ];

        return $finalOutputArray;
    }
}