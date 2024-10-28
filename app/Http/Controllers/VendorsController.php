<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    //
    public function detail($id){
        $vendor     = Vendor::find($id);
        return view('vendor.edit', compact('vendor'));

    }
    public function vendors(){

        $vendors = Vendor::orderBy('name')->paginate(15);
        return view('vendor.dashboard',compact('vendors'));

    }
    public function addVendorForm(){

        return view('vendor.add');
    }
    public function addVendor(Request $request){


//
        $vendor = Vendor::create(['name'=>$request->name]);
        if ($request->logo_image) {
            //dd($request->logo_image);
                $filename = $request->logo_image->store('public');
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
    public function delete(Vendor $vendor){
        return view('vendor.delete', ['vendor'=>$vendor]);
    }
    public function destroyVendor(Vendor $vendor){

        $vendor->delete();
        return redirect()->route('vendor_dashboard');
    }

}
