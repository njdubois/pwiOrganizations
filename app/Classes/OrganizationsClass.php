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
use DateTime;
use Illuminate\Http\Request;

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

        return $organizations->all();
    }

    /**
     * Accepts an organization ID and attempts to find a matching
     * record in the database.  If one isn't found, will return
     * a 404, organization not found error.
     *
     * @param $organizationId
     * @return array
     */
    public function getAnOrganization($organizationId) {
        $organization = Organization::find($organizationId);

        if (! $organization ) {
            abort(404, "Organization Not Found.\n\n" . __file__ . " @ Line " . __LINE__);
        }

        return $organization;
    }

    /**
     *
     * When returning a collection of records from the Organizations table, we need to format
     * a returning array to allow the front end to handle the data no matter how we change this
     * method.
     *
     * Loops through the whole collection and sends each record to a function that builds
     * an array based on one record.
     *
     * @param $allOrganizations
     * @return array
     */
    public function collectionOfOrganizationsToOutputArray($allOrganizations) {
        $organizationOutputArray = [];

        foreach($allOrganizations as $anOrganization) {
            $organizationOutputArray[] = $this->anOrganizationToArray($anOrganization);
        }

        return $organizationOutputArray;

    }

    /**
     * Takes the fields from a record, and returns a front end friendly
     * array.
     *
     * @param $anOrganization
     * @return array
     */
    public function anOrganizationToArray($anOrganization) {

        $causes = [];
        foreach($anOrganization->causes as $aCause) {
            $causes[$aCause->id] = $aCause->title;
        }

        $revenueClass = new RevenuesClass();
        $revenue = $revenueClass->getRevenueById($anOrganization->revenue_id)['title'];

        $date = DateTime::createFromFormat('Y-m-d', $anOrganization->established);

        $finalOutputArray = [
            'id' => $anOrganization->id,
            'name' => $anOrganization->name,
            'logo_filename' => $anOrganization->logo_filename,
            'established' => $date->format('m/d/Y'), // from yyyy-mm-dd to mm/dd/yyyy
            'revenue' => $revenue,
            'revenue_id' => $anOrganization->revenue_id,
            'causes' =>$causes
        ];

        return $finalOutputArray;
    }


    public function saveOrganizationUpdate($organizationId, Request $request) {

        $organization = $this->getAnOrganization($organizationId);
        $date = DateTime::createFromFormat('m/d/Y', $request->input('organizationEstablishedDate'));


        if ($request->hasFile('logo_file') && $request->file('logo_file') != "") {
            $file = $request->file('logo_file');

            $imageName = $date->format('Y-m-d') . "-" . $request->input('organizationName') . '.' . $file->getClientOriginalExtension();

            $request->file('logo_file')->move(
                base_path() . '/public/images/logos/', $imageName
            );

            $organization->logo_filename = $imageName;
        }


        $organization->name = $request->input('organizationName');
        $organization->established = $date->format('Y-m-d');
        $organization->revenue_id = $request->input('organizationRevenue');

        $organization->causes()->sync(  $request->input('cause_list')  );

        $organization->save();

        return true;
    }

    public function saveOrganizationCreate(Request $request) {

        $organization = new Organization;
        $date = DateTime::createFromFormat('m/d/Y', $request->input('organizationEstablishedDate'));


        if ($request->hasFile('logo_file') && $request->file('logo_file') != "") {
            $file = $request->file('logo_file');

            $imageName = $date->format('Y-m-d') . "-" . $request->input('organizationName') . '.' . $file->getClientOriginalExtension();

            $request->file('logo_file')->move(
                base_path() . '/public/images/logos/', $imageName
            );

            $organization->logo_filename = $imageName;
        }


        $organization->name = $request->input('organizationName');
        $organization->established = $date->format('Y-m-d');
        $organization->revenue_id = $request->input('organizationRevenue');


        $organization->save();

        $organization->causes()->attach(  $request->input('cause_list')  );


        return true;
    }

}