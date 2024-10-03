<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Location;
use App\Models\Organization;

use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function detail($id){

        $organization = Organization::find($id);
        $bbs = Bb::where('organization_id',$id)->select('bbs.*')->Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->get();
        $breadcrumbs['route']= 'organization';
        $breadcrumbs['list'][]= Array('route'=>'organizations','title'=>'Организации');
        return view('organization.detail',['organization'=>$organization,'bbs'=>$bbs,'breadcrumbs'=>$breadcrumbs]);

    }

    public function list(Request $request)
{
    $organizations = Organization::where('active','Y')->
    where(function($query)
    {
        global $request;
        if ($request->location) $query->where('location_id', $request->location );

    })->orderBy('title','asc')->paginate(10);
    $locations = Location::where('level',1)->orderBy('title')->get();
    return view('organization.list',['organizations'=>$organizations,'title'=>'Организации','locations'=>$locations,'request'=>$request]);
}
public function organization_site_redirect($id){
        $site = Organization::where('id',$id)->pluck('site')->first();

    $site = preg_replace('/^(https?:)?(\/\/)?(www\.)?/', '', $site);

     return redirect()->away('//'.$site);
}
}
