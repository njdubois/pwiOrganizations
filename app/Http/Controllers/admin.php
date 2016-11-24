<?php

namespace App\Http\Controllers;

use App\Classes\CausesClass;
use App\Classes\OrganizationsClass;
use App\Classes\RevenuesClass;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class admin extends Controller
{
    public function index() {

        $organizations = new OrganizationsClass();


        return view('admin_home')
            ->with("allOrganizations", $organizations->getAllOrganizations() )
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
            ->with("organizationDetails", [])
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
    public function saveNewOrganization() {

    }



    /**
     * loads the edit organization form
     * Method: GET
     *
     */
    public function editOrganization($organization_id) {
        $organizations = new OrganizationsClass();

        $causes = new CausesClass();
        $revenues = new RevenuesClass();

        return view('editOrganization')
            ->with("organizationDetails", $organizations->getAnOrganization($organization_id))
            ->with('allCauses', $causes->getAllCauses())
            ->with('allRevenues', $revenues->getAllRevenues())
        ;
    }

    /**
     *
     * Saves the incoming organization update
     * submit
     * method: POST
     * @param $organization_id
     * @param Request $request
     * @return $this
     */
    public function saveEditOrganization($organization_id, Request $request) {
        $organizations = new OrganizationsClass();

        $causes = new CausesClass();
        $revenues = new RevenuesClass();

        return view('editOrganization')
            ->with("organizationDetails", $organizations->getAnOrganization($organization_id))
            ->with('allCauses', $causes->getAllCauses())
            ->with('allRevenues', $revenues->getAllRevenues())
        ;
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

        return null;

    }

    public function signOut()  {
        session(['loggedUser' => ""]);

        return redirect("/");
    }
}
