<?php

namespace App\Http\Controllers;

use App\Classes\OrganizationsClass;
use Illuminate\Http\Request;

use App\Http\Requests;

class home extends Controller
{

    public function index() {
        $organizations = new OrganizationsClass();

        return view('index')
            ->with("allOrganizations",  $organizations->collectionOfOrganizationsToOutputArray( $organizations->getAllOrganizations() ));
        ;
    }
}
