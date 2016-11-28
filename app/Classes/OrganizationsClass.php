<?php


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


    /**
     *
     * Saves an update from the create/edit organization form.  Syncs cause
     * organization relationship.
     *
     * Method: Post
     *
     * @param $organizationId
     * @param Request $request
     * @return bool
     */
    public function saveOrganizationUpdate($organizationId, Request $request) {

        $organization = $this->getAnOrganization($organizationId);
        $organization = $this->getDataFromRequestIntoObject($organization, $request);

        // Update cause <-> organization pivot table.
        $organization->causes()->sync(  $request->input('cause_list')  );

        $organization->save();

        return true;
    }


    /**
     * Saves a new organization, it's cause/organization relationships and
     * any uploaded profile image.
     *
     * Method: POST
     *
     * @param Request $request
     * @return bool
     */
    public function saveOrganizationCreate(Request $request) {

        $organization = new Organization;
        $organization = $this->getDataFromRequestIntoObject($organization, $request);

        // save the new organization first because the indexes need to be there
        // before the relation can be formed between cause and organization.
        $organization->save();

        // Now that the database has been updated, "attach" the relation
        // to causes.

        // build the cause <-> organization relationship records
        $organization->causes()->attach(  $request->input('cause_list')  );

        return true;
    }

    /**
     *
     * Pulls data from the request saved from the organization create/edit form submit.
     *
     * @param $organization
     * @param Request $request
     * @return mixed
     */
    private function getDataFromRequestIntoObject($organization, Request $request) {
        $date = DateTime::createFromFormat('m/d/Y', $request->input('organizationEstablishedDate'));

        $organization = $this->testAndUploadLogo($organization, $date->format('Y-m-d'), $request);

        $organization->name = $request->input('organizationName');
        $organization->established = $date->format('Y-m-d');
        $organization->revenue_id = $request->input('organizationRevenue');

        return $organization;
    }


    /**
     *
     * Checks for an file:image in the request.  If found will
     * create a name based on the organization name and the current date and
     * then upload and moves the newly named file to the correct location.
     *
     * Finally sets the organization model objects logo file name
     * to the newly uploaded file name and returns the updated
     * organization object.
     *
     * @param $organization
     * @param $saveDate
     * @param Request $request
     * @return mixed
     */
    private function testAndUploadLogo($organization, $saveDate, Request $request) {

        if ($request->hasFile('logo_file') && $request->file('logo_file') != "") {
            $file = $request->file('logo_file');

            $imageName = $saveDate . "-" . $request->input('organizationName') . '.' . $file->getClientOriginalExtension();

            $request->file('logo_file')->move(
                base_path() . '/public/images/logos/', $imageName
            );

            $organization->logo_filename = $imageName;
        }

        return $organization;
    }


}