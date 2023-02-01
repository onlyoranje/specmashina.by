<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Location;
use App\Models\Rubric;
use App\Models\Bb;
use App\Models\UserFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use PhpParser\Node\Expr\Array_;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    private const BB_VALIDATOR = [
        'title' => 'required|max:50',

        'rubric_id' => 'required',
        'location_id' => 'required',
        'price' => 'required|numeric'
    ];

    private const BB_ERROR_MESSAGES = [
        'required' => 'Заполните это поле',
        'max' => 'Значение не должно быть длиннее :max символов',
        'numeric' => 'Введите число'
    ];

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function mybb() {
        return view('mybb',
            ['bbs' => Auth::user()->bbs()->latest()->get()]);
    }
    public function addForm(){
        $rubrics = Rubric::all();
        $locations = Location::all();
        return view('bb_add',['rubrics'=>$rubrics,'locations'=>$locations]);
    }
    public function addBb(Request $request){
        //dd($request);
        $validated = $request->validate(self::BB_VALIDATOR,self::BB_ERROR_MESSAGES);
        $description = $request->description;
        $bb = Auth::user()->bbs()->create(['title'=>$validated['title'],'price'=>$validated['price'],'content'=>$description,'rubric_id'=>$validated['rubric_id'],'location_id'=>$validated['location_id']]);
        if ($request->file) {
            if (is_array($request->file) ) {
                foreach ($request->file as $file_upload) {
                    if (!is_null($file_upload)) {
                        $filename = $file_upload->store('public');
                        $file_name = explode('/', $filename);
                        UserFile::create(['bb_id' => $bb->id, 'url' => $file_name[1],'type' => $file_upload->extension(),'size' => $file_upload->getSize(),'original_name' => $file_upload->getClientOriginalName()]);
                    }
                }
            } else {

                $filename = $request->file->store('public');
                $file_name = explode('/', $filename);
                UserFile::create(['bb_id' => $bb->id, 'url' => $file_name[1],'type' => $request->file->extension(),'size' => $request->file->getSize(),'original_name' => $request->file->getClientOriginalName()]);

            }}
        return redirect()->route('dashboard');
    }
    public function editBb(Bb $bb){

        $all_rubrics = Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
        $rubrics = Rubric::all();
        $all_locations = Location::whereAncestorOrSelf($bb->location_id)->orderBy('level')->get();
        $locations= Location::all();
        $images = UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();
        return view('bb_edit',['bb'=>$bb,'rubrics'=>$rubrics,'all_rubrics'=>$all_rubrics,'locations'=>$locations,'all_locations'=>$all_locations,'images'=>$images]);
    }
    public function updateBb(Request $request,Bb $bb){

        $validated = $request->validate(self::BB_VALIDATOR,self::BB_ERROR_MESSAGES);
        $description = $request->description;
        $bb->fill(['title'=>$validated['title'],'price'=>$validated['price'],'content'=>$description]);
        $bb->save();
        if ($request->rubric_id) {
            $bb->fill(['rubric_id'=>$request->rubric_id]);
            $bb->save();
        }
        if ($request->location_id) {
            $bb->fill(['location_id'=>$request->location_id]);
            $bb->save();
        }
        //dd($request);

        if ($request->file) {
            if (is_array($request->file) ) {
                foreach ($request->file as $file_upload) {
                    if (!is_null($file_upload)) {
                    $filename = $file_upload->store('public');
                    $file_name = explode('/', $filename);
                    UserFile::create(['bb_id' => $bb->id, 'url' => $file_name[1],'type' => $file_upload->extension(),'size' => $file_upload->getSize(),'original_name' => $file_upload->getClientOriginalName()]);
                    }
                }
            } else {

                $filename = $request->file->store('public');
                $file_name = explode('/', $filename);
                UserFile::create(['bb_id' => $bb->id, 'url' => $file_name[1],'type' => $request->file->extension(),'size' => $request->file->getSize(),'original_name' => $request->file->getClientOriginalName()]);

        }}
        $files_before_edit=UserFile::where('bb_id',$bb->id)->pluck('id');
        foreach ($files_before_edit as $fid){
            $fida[] = $fid;
        }
        if ($request['fileuploader-list-file']){

            $old_files = json_decode($request['fileuploader-list-file'],true);
            $old_files_=Array();
            foreach ($old_files as $old_file_array){
                if (is_numeric($old_file_array['file'])){
                    $old_file = UserFile::find($old_file_array['file']);
                    $old_file->fill(['sort' => $old_file_array['index']]);
                    $old_file->save();
                    $old_files_[]=$old_file_array['file'];
                } else {
                    $file_name = explode('/', $old_file_array['file']);

                    $old_file = UserFile::where('original_name',$file_name[1])->firstWhere('bb_id',$bb->id);
                    $old_files_[]=$old_file->id;
                    $old_file->fill(['sort' => $old_file_array['index']]);

                    $old_file->save();
                }

            }
if (count($old_files_)>0){$for_delete = array_diff($fida,$old_files_);} else {$for_delete=$fida;}


            foreach ($for_delete as $old_file_delete )
            {

                    Storage::delete($old_file_delete);
                    UserFile::destroy($old_file_delete);

            }
        }

        return redirect()->route('mybb');
    }
    public function deleteBb(Bb $bb){
        return view('bb_delete', ['bb'=>$bb]);
    }
    public function destroyBb(Bb $bb){
        $bb->delete();
        return redirect()->route('mybb');
    }
}
