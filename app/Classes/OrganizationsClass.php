<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 11/23/16
 * Time: 12:42 PM
 */

namespace App\Classes;


use App\Classes\RevenuesClass;
use App\Organization;
use App\Revenue;

class OrganizationsClass
{
    public $allOrganizations;

    /**
     *
     * Get all organizations from the database and runs it through a
     * formatting function that turns the cause collect and revenue id
     * into human readable output.
     *
     * @return array
     */
    public function getAllOrganizations() {
        $organizations = Organization::all();

        return $this->collectionOfOrganizationsToOutputArray($organizations->all());
    }

    public function getAnOrganization($organizationId) {
        $organization = Organization::find($organizationId);

        if (! $organization ) {
            abort(404, 'Organization Not Found.');
        }

        return $this->anOrganizationToArray($organization);
    }

    private function collectionOfOrganizationsToOutputArray($allOrganizations) {
        $organizationOutputArray = [];

        foreach($allOrganizations as $anOrganization) {
            $organizationOutputArray[] = $this->anOrganizationToArray($anOrganization);
        }

        return $organizationOutputArray;

    }

    private function anOrganizationToArray($anOrganization) {

        $causes = [];
        foreach($anOrganization->causes as $aCause) {
            $causes[$aCause->id] = $aCause->title;
        }

        $revenueClass = new RevenuesClass();
        $revenue = $revenueClass->getRevenueById($anOrganization->revenue_id)['title'];

        $finalOutputArray = [
            'id' => $anOrganization->id,
            'name' => $anOrganization->name,
            'logo_filename' => $anOrganization->logo_filename,
            'established' => $anOrganization->established,
            'revenue' => $revenue,
            'causes' =>$causes
        ];

        return $finalOutputArray;
    }
}