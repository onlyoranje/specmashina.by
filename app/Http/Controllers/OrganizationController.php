<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function detail(){

        return view('organization.my_organization');

    }

    public function list()
{
    $organizations = Organization::where('active','Y')->orderBy('title','asc')->paginate(20);
    return view('organization.list',['organizations'=>$organizations,'title'=>'Организации']);
}
}
