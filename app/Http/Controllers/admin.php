<?php

namespace App\Http\Controllers;

use App\Classes\CausesClass;
use App\Classes\OrganizationsClass;
use App\Classes\RevenuesClass;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class admin extends Controller
{
    public function index() {

        $organizations = new OrganizationsClass();


        return view('admin_home')
            ->with("allOrganizations", $organizations->collectionOfOrganizationsToOutputArray( $organizations->getAllOrganizations() ))
            ->with("admin", true)
            ;
    }

    /**
     * loads the create new organization form
     * Method: GET
     *
     */
    public function createOrganization() {

        $causes = new CausesClass();
        $revenues = new RevenuesClass();

        return view('createOrganization')
            ->with("organizationDetails", null)
            ->with('allCauses', $causes->getAllCauses())
            ->with('allRevenues', $revenues->getAllRevenues())
        ;
    }

    /**
     *
     * Saves the incoming new organization
     * submit
     * method: POSTS
     *
     */
    public function saveNewOrganization(Request $request) {


        $v = Validator::make($request->all(), [
            'logo_file' => 'required|mimes:jpeg,jpg,png',
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }

        $organizations = new OrganizationsClass();

        if ( ! $organizations->saveOrganizationCreate($request) ) {
            return "Create Error";
        }

        return $this->index();
    }



    /**
     * loads the edit organization form
     * Method: GET
     *
     */
    public function editOrganization($organizationId) {
        $organizations = new OrganizationsClass();

        $organizationsArray = $organizations->anOrganizationToArray($organizations->getAnOrganization($organizationId) );

        $causes = new CausesClass();
        $revenues = new RevenuesClass();

        return view('editOrganization')
            ->with("organizationDetails", $organizationsArray)
            ->with('allCauses', $causes->getAllCauses())
            ->with('allRevenues', $revenues->getAllRevenues())
        ;
    }

    /**
     *
     * Saves the incoming organization update
     * submit
     * method: POST
     * @param $organizationId
     * @param Request $request
     * @return String or View
     */
    public function saveEditOrganization($organizationId, Request $request) {

        $organizations = new OrganizationsClass();

        if ( ! $organizations->saveOrganizationUpdate($organizationId, $request) ) {
            return "Update Error";
        }

        return $this->editOrganization($organizationId);
    }


    public function signIn(Request $request) {
        $users = User::all();

        $aUser = $users
            ->where("email", $request->input("email"))
            ->first()
        ;

        if (Hash::check($request->input("password"), $aUser->password))
        {
            session(['loggedUser' => $aUser->name]);

            return redirect("/admin");
        }

        return redirect("/");

    }

    public function signOut()  {
        session(['loggedUser' => ""]);

        return redirect("/");
    }
}
