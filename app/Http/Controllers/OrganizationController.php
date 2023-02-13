<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function detail(){

        return view('organization.my_organization');

    }
    public function add(){
        return view('organization.add');
    }
}
