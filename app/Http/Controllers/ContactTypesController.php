<?php

namespace App\Http\Controllers;

use App\Models\ContactType;
use Illuminate\Http\Request;

class ContactTypesController extends Controller
{
    public function types(){

        $types = ContactType::orderBy('sort')->get();
        return view('contact_type.dashboard',compact('types'));

    }
    public function addTypeForm($id=false){

        return view('contact_type.add');
    }
    public function addTypetoDB(Request $request){

        ContactType::create(['name'=>$request->name,'sort'=>$request->sort,'icon'=>$request->icon,'mask'=>$request->mask,'required'=>$request->contact_required]);

        return redirect()->route('contact_type_dashboard');
    }
    public function detail($id){
        $type     = ContactType::find($id);

        return view('contact_type.edit', ['type'=>$type]);

    }
    public function editType(Request $request, ContactType $type){

        $contact_required = 'N';
        if ($request->contact_required) $contact_required =  $request->contact_required;

        $type->fill(['name'=>$request->name,'sort'=>$request->sort,'icon'=>$request->icon,'mask'=>$request->mask,'required'=>$contact_required]);
        $type->save();
       // dd($contact_required);
        return redirect()->route('contact_type_dashboard');
    }
    public function delete(ContactType $type){
        return view('contact_type.delete', ['type'=>$type]);
    }
    public function destroy(ContactType $type){

        $type->delete();
        return redirect()->route('contact_type_dashboard');
    }
}
