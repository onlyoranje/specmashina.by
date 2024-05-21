<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\BbAdminComments;
use App\Models\BbContact;
use App\Models\BbParameters;
use App\Models\BbPrice;
use App\Models\BbStatistic;
use App\Models\ContactType;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Parameter;
use App\Models\PriceType;
use App\Models\PriceTypeRubric;
use App\Models\Rubric;
use App\Models\Bb;
use App\Models\Status_bb;
use App\Models\UserFile;
use Composer\XdebugHandler\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Laravolt\Avatar\Avatar;
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
        'price_type' => 'required',
        'location_id' => 'required'
    ];

    private const BB_ERROR_MESSAGES = [
        'required' => 'Заполните это поле',
        'max' => 'Значение не должно быть длиннее :max символов',
        'numeric' => 'Введите число'
    ];
    private const ORG_VALIDATOR = [
        'title' => 'required',
        'unp' => 'required',
        'address' => 'required'
    ];

    private const ORG_ERROR_MESSAGES = [
        'required' => 'Заполните это поле',
        'max' => 'Значение не должно быть длиннее :max символов',
        'numeric' => 'Введите число'
    ];
    public function edit(Request $request): View
    {


        return view('profile.edit', [
            'user' => $request->user(),'locations' =>Location::all()
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $request->user()->fill($request->validated());
//dd($request);
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->fill(['phone'=>$request->phone,'realname'=>$request->realname]);
        $request->user()->save();
        if ($request->profileimage) {

            $filename = $request->profileimage->store('public');
            $file_name = explode('/', $filename);
            $request->user()->fill(['avatar'=> $file_name[1]]);
            $request->user()->save();

        }
        if ($request->remove_avatar=='remove')
        {

            $request->user()->fill(['avatar'=> null]);
            $request->user()->save();
        }
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
    public function mybb(Request $request) {
        $bbs_last =  Auth::user()->bbs()->where(function($query)
        {
            global $request;
            if ($request->status_id) $query->where('status_bb_id', $request->status_id );

        })->latest()->paginate(10);
        $status_bb = Status_bb::OrderBy('sort','asc')->get();
        $bbs_count = Auth::user()->bbs->count();
        return view('bb.mybb',
            [
                'bbs' => $bbs_last,
                'status_bb'=>$status_bb,
                'request'=>$request,
                'bbs_count'=>$bbs_count
            ]);
    }
    public function addForm(){
        $user = Auth::user();
        $rubrics = Rubric::all();
        $locations = Location::all();
        $parameters = Parameter::all();
        $price_types = PriceType::orderBy('sort')->get();
        $contact_types = ContactType::orderBy('sort')->get();
        $parameter_rubric = DB::table('parameter_rubric')->get();
        $price_type_rubric = PriceTypeRubric::select('*','price_types.sort as sort')->join('price_types','price_type_rubric.price_type_id','=','price_types.id')->orderBy('sort')->get();
        //dd($price_type_rubric);
        return view('bb.add',[
            'user'=>$user,
            'rubrics'=>$rubrics,
            'locations'=>$locations,
            'parameters'=>$parameters,
            'parameter_rubric'=>$parameter_rubric,
            'contact_types'=>$contact_types,
            'price_types'=>$price_types,
            'price_type_rubric'=>$price_type_rubric
        ]);
    }
    public function addBb(Request $request){
        //dd($request);
        $validated = $request->validate(self::BB_VALIDATOR,self::BB_ERROR_MESSAGES);
        $description = $request->description;
        $status_bb_id = Status_bb::where('status','M')->get()->value('id');
        $bb = Auth::user()->bbs()->create(['title'=>$validated['title'],'content'=>$description,'rubric_id'=>$validated['rubric_id'],'vendor_id'=>$request->vendor_id,'location_id'=>$validated['location_id'],'status_bb_id'=>$status_bb_id]);
        if ($request->file) {
            if (is_array($request->file) ) {
                foreach ($request->file as $file_upload) {
                    if (!is_null($file_upload)) {
                        $filename = $file_upload->store('public/bb');
                        $file_name = explode('/', $filename);
                        UserFile::create(['bb_id' => $bb->id, 'url' => $file_name[1].'/'.$file_name[2],'type' => $file_upload->extension(),'size' => $file_upload->getSize(),'original_name' => $file_upload->getClientOriginalName()]);
                    }
                }
            } else {

                $filename = $request->file->store('public/bb');
                $file_name = explode('/', $filename);
                UserFile::create(['bb_id' => $bb->id, 'url' => $file_name[1].'/'.$file_name[2],'type' => $request->file->extension(),'size' => $request->file->getSize(),'original_name' => $request->file->getClientOriginalName()]);

            }}
        if ($request->parameter){
            foreach ($request->parameter as $parameter_id=>$value){
                if (!is_null($value))  BbParameters::create(['bb_id' => $bb->id,'value'=>$value, 'parameter_id'=>$parameter_id]);
            }
        }

        $bbprice = BbPrice::create(['bb_id' => $bb->id, 'price_type_id'=>$validated['price_type']]);

            $bbprice->fill(['price'=>$request->price]);
            $bbprice->save();

        if (is_array($request->contact)) {
            foreach ($request->contact as $contact_type_id=>$contact_value) {
                if ($contact_value)  BbContact::create(['value'=>$contact_value,'bb_id'=>$bb->id,'contact_type_id'=>$contact_type_id]);
            }

        }

            $bb->fill(['organization_id'=>Auth::user()->organization->id]);
            $bb->save();


        return redirect()->route('mybb');
    }
    public function editBb(Bb $bb){
        $user = Auth::user();
        $parameter_value = Array();
        $contact_value = Array();
        $all_rubrics = Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
        $rubrics = Rubric::all();
        $all_locations = Location::whereAncestorOrSelf($bb->location_id)->orderBy('level')->get();
        $locations = Location::all();
        $parameters = Parameter::all();
        $price_types = PriceType::orderBy('sort')->get();
        $contact_types = ContactType::orderBy('sort')->get();
        $parameter_rubric = DB::table('parameter_rubric')->get();
        $price_type_rubric = PriceTypeRubric::select('*','price_types.sort as sort')->join('price_types','price_type_rubric.price_type_id','=','price_types.id')->orderBy('sort')->get();

        $parameter_values = BbParameters::where('bb_id',$bb->id)->get();

        foreach ($parameter_values as $pv){
            $parameter_value[$pv->parameter_id]=$pv->value;
        }
        $contacts = BbContact::where('bb_id',$bb->id)->get();
        foreach ($contacts as $contact){
            $contact_value[$contact->contact_type_id]=$contact->value;
        }
        $images = UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();

        return view('bb.edit',[
            'user'=>$user,
            'bb'=>$bb,
            'rubrics'=>$rubrics,
            'all_rubrics'=>$all_rubrics,
            'locations'=>$locations,
            'all_locations'=>$all_locations,
            'parameters'=>$parameters,
            'images'=>$images,
            'parameter_rubric'=>$parameter_rubric,
            'parameter_value'=>$parameter_value,
            'contact_types'=>$contact_types,
            'contacts'=>$contact_value,
            'price_types'=>$price_types,
            'price_type_rubric'=>$price_type_rubric]);
    }
    public function updateBb(Request $request,Bb $bb){

        $validated = $request->validate(self::BB_VALIDATOR,self::BB_ERROR_MESSAGES);
        $description = $request->description;
        $status_bb_id = Status_bb::where('status','M')->get()->value('id');
        $search_text[] = $validated['title'];
        $bb->fill(['title'=>$validated['title'],'content'=>$description,'vendor_id'=>$request->vendor_id,'status_bb_id'=>$status_bb_id]);
        $bb->save();
        if ($request->rubric_id) {
            $bb->fill(['rubric_id'=>$request->rubric_id]);
            $rubrics = Rubric::whereAncestorOrSelf($request->rubric_id)->get();
            foreach ($rubrics as $rubric)
            {
                $search_text[] = $rubric->title;
            }
            $bb->save();
        }
        if ($request->location_id) {
            $bb->fill(['location_id'=>$request->location_id]);
            $locations = Location::whereAncestorOrSelf($request->location_id)->get();
            foreach ($locations as $location)
            {
                $search_text[] = $location->title;
            }
            $bb->save();
        }


        if (is_array($request->contact)) {
            foreach ($request->contact as $contact_type_id=>$contact_value) {
                if ($contact_value)  BbContact::updateOrCreate(['bb_id'=>$bb->id,'contact_type_id'=>$contact_type_id],['value'=>$contact_value]);
            }

        }

        if ($request->file) {
            if (is_array($request->file) ) {
                foreach ($request->file as $file_upload) {
                    if (!is_null($file_upload)) {
                    $filename = $file_upload->store('public/bb');
                    $file_name = explode('/', $filename);
                    UserFile::create(['bb_id' => $bb->id, 'url' => $file_name[1].'/'.$file_name[2],'type' => $file_upload->extension(),'size' => $file_upload->getSize(),'original_name' => $file_upload->getClientOriginalName()]);
                    }
                }
            } else {

                $filename = $request->file->store('public/bb');
                $file_name = explode('/', $filename);
                UserFile::create(['bb_id' => $bb->id, 'url' => $file_name[1].'/'.$file_name[2],'type' => $request->file->extension(),'size' => $request->file->getSize(),'original_name' => $request->file->getClientOriginalName()]);

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
        if ($request->parameter) {
            $parameters_new = [];
            $parameters_old = BbParameters::where('bb_id',$bb->id)->pluck('parameter_id')->toArray();;

            foreach ($request->parameter as $parameter_id => $value) {
                if (!is_null($value)) {
                    $parameters_new[] = $parameter_id;
                    BbParameters::updateOrCreate(['bb_id' => $bb->id, 'parameter_id' => $parameter_id], ['value' => $value]);
                }

            }

            BbParameters::where('bb_id', $bb->id)->whereIn('parameter_id', array_diff($parameters_old,$parameters_new))->delete();
        }

            $bb->fill(['organization_id'=>Auth::user()->organization->id]);
            $search_text[] = Auth::user()->organization->title;
            $bb->save();

        $bb->bbprice->fill(['price'=>$request->price,'price_type_id'=>$request->price_type]);
        $bb->bbprice->save();
        //dd($parameters_old);
        $bb->fill(['search_text'=>implode(' ',$search_text)]);
        $bb->save();

        return redirect()->route('mybb');
    }
    public function deleteBb(Bb $bb){
        return view('bb.delete', ['bb'=>$bb]);
    }
    public function destroyBb(Bb $bb){
        $bb->delete();
        return redirect()->route('mybb');
    }
    public function MyOrganization(){
        $organization = Organization::where('user_id',Auth::user()->id)->first();
        $locations = Location::all();
        if ($organization)
        {
            $all_locations = Location::whereAncestorOrSelf($organization->location_id)->orderBy('level')->get();
            return view('organization.my_organization',['organization' => Organization::where('user_id',Auth::user()->id)->first(),'locations'=>$locations,           'all_locations'=>$all_locations]);
        }
        else
        {
            return view('organization.add',['locations'=>$locations]);
        }


    }
    public function addOrganization(){
        $locations = Location::all();
        return view('organization.add',['locations'=>$locations]);
    }
    public function addOrganizationToDB(Request $request){

        //$old_files = json_decode($request['fileuploader-list-file'],true);
        $validated = $request->validate(self::ORG_VALIDATOR,self::ORG_ERROR_MESSAGES);
        $org = new Organization([
            'title'=>$validated['title'],
            'address'=>$validated['address'],
            'unp'=>$validated['unp'],
            'location_id'=>$request->location_id,
            'phone'=>$request->phone,
            'site'=>$request->site,
            'email'=>$request->email
        ]);
        $org->user()->associate(Auth::user());
        $org->save();
        if ($request->file) {

            $filename = $request->file[0]->store('public');
            $file_name = explode('/', $filename);
            $org->fill(['logo'=> $file_name[1]]);
            $org->save();

        }

        return redirect()->route('my_organization');

    }
    public function editOrganization(){

        return view('organization.edit',['organization' => Organization::where('user_id',Auth::user()->id)->first()]);
    }
    public function deleteOrganization(Organization $organization){
        $organization = Organization::where('user_id',Auth::user()->id)->first();
        return view('organization.delete', ['organization'=>$organization]);
    }
    public function destroyOrganization(){
        Organization::where('user_id',Auth::user()->id)->delete();
        return redirect()->route('my_organization');
    }
    public function updateOrganization(Request $request){
//dd($request);

        $old_files = json_decode($request['fileuploader-list-file'],true);
        $validated = $request->validate(self::ORG_VALIDATOR,self::ORG_ERROR_MESSAGES);
        $organization = Auth::user()->organization;
        $organization->fill([
            'title'=>$validated['title'],
            'address'=>$validated['address'],
            'unp'=>$validated['unp'],
            'location_id'=>$request->location_id,
            'phone'=>$request->phone,
            'site'=>$request->site,
            'email'=>$request->email
        ]);
        $organization->save();
        if ($request->file) {

            $filename = $request->file->store('public');
            $file_name = explode('/', $filename);
            $organization->fill(['logo'=> $file_name[1]]);
            $organization->save();

        }
       /* if (!is_array($old_files))
        {
            $organization->fill(['logo'=> null]);
            $organization->save();
        }*/
        //test comment
        return redirect()->route('my_organization');
    }
    public function admin_dashboard(){
        $bbs = Bb::all();
        $bbs_popular =
            Bb::addSelect(
                ['status' => Status_bb::selectRaw('active')->
                whereColumn('id','bbs.status_bb_id')]
            )->
            addSelect(
                ['bbstatistic_count' =>
                    BbStatistic::selectRaw('sum(views) as total')
                        ->whereColumn('bb_id', 'bbs.id')
                        ->groupBy('bb_id')
                ]
            )->

            orderBy('bbstatistic_count','desc')->
            limit(5)->
            get();
        $bbs_active = Bb::select('bbs.*')->Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->get();
        $bbs_moderation = Bb::select('bbs.*')->Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.status','M')->orderBy('bbs.updated_at','asc')->get();
        $bbs_moderation_fail = Bb::where('user_id',Auth::id())->select('bbs.*')->Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.status','N')->get();
        $notifications = Auth::user()->notifications->sortBy('created_at')->reverse();

        return view('dashboard',['bbs'=>$bbs,'bbs_active'=>$bbs_active,'bbs_moderation'=>$bbs_moderation,'bbs_popular'=>$bbs_popular, 'bbs_moderation_fail'=>$bbs_moderation_fail,'notifications'=>$notifications ]);
    }
    public function dashboard(){
            $bbs = Bb::where('user_id',Auth::id())->get();
            $bbs_popular =
                Bb::where('user_id',Auth::id())->
                addSelect(
                    ['status' => Status_bb::selectRaw('status')->
                    whereColumn('id','bbs.status_bb_id')]
                )->
                addSelect(
                    ['bbstatistic_count' =>
                        BbStatistic::selectRaw('sum(views) as total')
                ->whereColumn('bb_id', 'bbs.id')
                ->groupBy('bb_id')
            ]
                )->

                orderBy('bbstatistic_count','desc')->
                limit(5)->
                get();
            $bbs_active = Bb::where('user_id',Auth::id())->select('bbs.*')->Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->get();
            $bbs_moderation = Bb::where('user_id',Auth::id())->select('bbs.*')->Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.status','M')->get();
            $bbs_moderation_fail = Bb::where('user_id',Auth::id())->select('bbs.*')->Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.status','N')->get();
            $bbs_admin_comments = BbAdminComments::Join('bbs','bbs.id','=','bb_admin_comments.bb_id')->where('bbs.user_id',Auth::id())->orderBy('bb_admin_comments.created_at','desc')->get();
            $notifications = Auth::user()->notifications->sortBy('created_at')->reverse();
        return view('dashboard',['bbs'=>$bbs,'bbs_active'=>$bbs_active,'bbs_moderation'=>$bbs_moderation,'bbs_moderation_fail'=>$bbs_moderation_fail,'bbs_popular'=>$bbs_popular , 'bbs_admin_comments'=>$bbs_admin_comments,'notifications'=>$notifications ]);
    }
}
