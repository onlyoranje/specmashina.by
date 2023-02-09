<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    //
    public function detail($id){
        $vendor     = Vendor::find($id);
        return view('vendor.vendor_edit', compact('vendor'));

    }
    public function vendors(){

        $vendors = Vendor::orderBy('name')->get();
        return view('vendor.vendor_dashboard',compact('vendors'));

    }
    public function addVendorForm(){

        return view('vendor.vendor_add');
    }
    public function addVendor(Request $request){



        $vendor = Vendor::create(['name'=>$request->name]);
        if ($request->file) {

                $filename = $request->file->store('public');
                $file_name = explode('/', $filename);
                $vendor->fill(['logo'=> $file_name[1]]);
                $vendor->save();

            }
        return redirect()->route('vendor_dashboard');
    }
    public function editvendor(Request $request, Vendor $vendor){
//dd($request);

        $old_files = json_decode($request['fileuploader-list-file'],true);
        $vendor->fill(['name'=>$request->name]);
        $vendor->save();
        if ($request->file) {

            $filename = $request->file->store('public');
            $file_name = explode('/', $filename);
            $vendor->fill(['logo'=> $file_name[1]]);
            $vendor->save();

        }
        if (!is_array($old_files))
        {
            $vendor->fill(['logo'=> null]);
            $vendor->save();
        }
        return redirect()->route('vendor_dashboard');
    }

}
