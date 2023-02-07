<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    //
    public function detail($id){
        $vendor     = Vendor::find($id);
        return view('vendor_edit', compact('vendor'));

    }
    public function vendors(){

        $vendors = Vendor::orderBy('name')->get();
        return view('vendor.vendor_dashboard',compact('vendors'));

    }
    public function addVendorForm(){

        return view('vendor.vendor_add');
    }

}
