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


    /**
     * Admin home page.  Expects an array of all organizations.  Setting
     * "admin" to true displays "Edit" button next to each organization.
     *
     */
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

        // Could use this for all inputs, but for now just
        // make sure the image in the file input is of type
        // jpeg, jpg or png.
        $validatePage = Validator::make($request->all(), [
            'logo_file' => 'required|mimes:jpeg,jpg,png',
        ]);

        // Are there any errors?
        if ($validatePage->fails())
        {
            // Yes, redirect back and send the errors to the view.
            return redirect()->back()->withErrors($validatePage->errors());
        }

        // No errors, try to create the record.
        $organizations = new OrganizationsClass();

        if ( ! $organizations->saveOrganizationCreate($request) ) {
            // There was an error creating the record.
            return "Create Error";
        }

        // All done, send them to the home page.
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


    /**
     *
     * Handles the logging in of a user.  Placed database code in here to be simple, ideally
     * would use the laravel built in authentication but for the sake of time just hammered
     * this out.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function signIn(Request $request) {
        $users = User::all();

        $aUser = $users
            ->where("email", $request->input("email"))
            ->first()
        ;

        if (Hash::check($request->input("password"), $aUser->password))
        {

            // log in successful, send them to the admin home page.
            session(['loggedUser' => $aUser->name]);
            return redirect("/admin");
        }

        // log in fail, lets not alert any malicious users, and just send them home.
        return redirect("/");
    }

    /**
     *
     * Sign out is easy, clear the session value.  Redirect home.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function signOut()  {
        session(['loggedUser' => ""]);

        return redirect("/");
    }
}
