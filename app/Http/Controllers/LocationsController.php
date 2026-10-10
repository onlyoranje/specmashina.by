<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LocationsController extends Controller
{
    private const LOC_VALIDATOR = [
        'title'=> 'required|max:100'
    ];
    private const LOC_ERROR_MESSAGES = [
        'max'=>' Значение не долно быть длиннее :max символов'
    ];
    public function detail($id){
        $location     = Location::find($id);
        $locations    = Location::orderBy('sort')->get()->toTree();
        $depth      = Location::descendantsAndSelf($id)->toFlatTree();

        return view('location.edit', ['location'=>$location,'locations'=>$locations,'depth'=>$depth]);

    }
    public function list(Request $request)
    {

        $locations_letter = Location::select(DB::raw('substring(title,1,1) as loc_letter'))->where('level',1)->groupBy('loc_letter')->orderBy('loc_letter','asc')->pluck('loc_letter');

        $locations = Location::withCount([
            'bbs' => function (Builder $query) {
                $query->where('active', 'Y');
            },
        ])
            ->where('title',"LIKE", $request->letter."%" )
            ->where('level',1)->orderBy('title','asc')->paginate(10);
        return view('location.list',['title'=>'Аренда техники в Беларуси','locations'=>$locations,'request'=>$request,'locations_letter'=>$locations_letter]);
    }
    public function location($id){
        $location     = Location::find($id);
        $locations    = Location::descendantsAndSelf($id)->pluck('id');
        $announcements    = Bb::whereIn('location_id',$locations)->get();
        $breadcrumbs= Location::ancestorsAndSelf($id);
        return view('location.location', ['location'=>$location,'Locations'=>$locations,'breadcrumbs'=>$breadcrumbs,'announcements'=>$announcements]);

    }
    /**
     * Список городов: пагинация (10 на страницу) + поиск по названию (?q=...).
     *
     * Поиск работает и без JS — обычная GET-форма в location/dashboard.blade.php —
     * и через AJAX: та же выборка отдаётся LocationsController::search() как
     * HTML-фрагмент списка вместе с пагинацией.
     */
    public function locations(Request $request)
    {
        $locations = $this->locationsQuery($request)->paginate(10)->withQueryString();

        return view('location.dashboard', [
            'locations' => $locations,
            'q'         => $this->searchTerm($request),
        ]);
    }

    /**
     * AJAX-поиск по названию города (/dashboard/location/search?q=...&page=N).
     *
     * Отдаём JSON с готовым HTML-фрагментом «список + пагинация» и общим
     * количеством найденного — public/js/location-search.js просто подменяет
     * содержимое #location-results, не перезагружая страницу.
     */
    public function search(Request $request)
    {
        $locations = $this->locationsQuery($request)->paginate(10)->withQueryString();

        return response()->json([
            'html'  => view('location.partials.list', [
                'locations' => $locations,
                'q'         => $this->searchTerm($request),
            ])->render(),
            'total' => $locations->total(),
        ]);
    }

    /**
     * Поисковая строка из ?q=. Принимается только строка: параметр вида
     * ?q[]=… (массив) считается пустым запросом и не попадает ни в шаблон,
     * ни в SQL.
     */
    private function searchTerm(Request $request): string
    {
        $q = $request->query('q', '');

        return is_string($q) ? trim($q) : '';
    }

    /**
     * Общий запрос списка городов: сортировка по названию и опциональный
     * фильтр по title («Минск») либо по title_r — форме названия для заголовков
     * («Минской области», «Минске»), чтобы находили и склонения.
     * Символы-шаблоны LIKE (%, _, \) экранируются, чтобы запрос не «ломал» выборку.
     */
    private function locationsQuery(Request $request): Builder
    {
        $q = $this->searchTerm($request);

        return Location::query()
            ->when($q !== '', function (Builder $query) use ($q) {
                $pattern = '%' . addcslashes($q, '%_\\') . '%';

                $query->where(function (Builder $nested) use ($pattern) {
                    $nested->where('title', 'LIKE', $pattern)
                        ->orWhere('title_r', 'LIKE', $pattern);
                });
            })
            ->orderBy('title');
    }
    public function addLocationForm(){
        $locations = Location::orderBy('sort')->get()->toTree();

        return view('location.add',compact('locations'));
    }
    public function addLocation(Request $request){
        $validated = $request->validate(self::LOC_VALIDATOR,self::LOC_ERROR_MESSAGES);
        if ($request->parent_id)
            $level = (Location::find($request->parent_id)->level)+1;
        else
            $level=0;
        $location = Location::create(['title'=>$validated['title'],'title_r'=>$request->title_r,'parent_id'=>$request->parent_id,'level'=>$level,'sort'=>$request->sort]);

        if ($request->file) {

            $filename = $request->file[0]->store('public');
            $file_name = explode('/', $filename);
            $location->fill(['image'=> $file_name[1]]);
            $location->save();

        }
        return redirect()->route('location_dashboard');
    }
    public function editLocation(Request $request, Location $location){
        $validated = $request->validate(self::LOC_VALIDATOR,self::LOC_ERROR_MESSAGES);
        if ($request->parent_id)
            $level = (Location::find($request->parent_id)->level)+1;
        else
            $level=0;
        $location->fill(['title'=>$validated['title'],'title_r'=>$request->title_r,'parent_id'=>$request->parent_id,'level'=>$level,'sort'=>$request->sort]);
        $location->save();

        if ($request->file) {

            $filename = $request->file->store('public');
            $file_name = explode('/', $filename);
            $location->fill(['image'=> $file_name[1]]);
            $location->save();

        } else {
            $location->fill(['image'=> null]);
            $location->save();
        }
        return redirect()->route('location_dashboard');
    }
    public function delete(Location $location){
        return view('location.delete', ['location'=>$location]);
    }
    public function destroyLocation(Location $location){
        $location->delete();
        return redirect()->route('location_dashboard');
    }
}
