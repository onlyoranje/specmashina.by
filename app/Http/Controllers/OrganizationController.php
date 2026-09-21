<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use App\Models\Location;
use App\Models\Organization;

use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    // Профиль организации (редизайн 2026) + сетка активных объявлений.
    public function detail($id)
    {
        $organization = Organization::findOrFail($id);

        $listings = Bb::where('organization_id', $organization->id)
            ->whereHas('status_bb', fn ($q) => $q->where('active', 'Y'))
            ->with(['location', 'bbprice.pricetype', 'BbParameters.parameters'])
            ->orderByDesc('id')
            ->get();

        return view('organizations.show', [
            'organization' => $organization,
            'listings'     => $listings,
        ]);
    }

    // Каталог компаний (редизайн 2026): поиск по названию + фильтр по городу.
    public function list(Request $request)
    {
        $organizations = Organization::where('active', 'Y')
            ->when($request->filled('q'), fn ($q) => $q->where('title', 'like', '%'.$request->q.'%'))
            ->when($request->filled('city_id'), fn ($q) => $q->where('location_id', $request->city_id))
            // Число АКТИВНЫХ объявлений компании (связь status_bb — как на главной)
            ->withCount(['bbs as listings_count' => fn ($q) => $q
                ->whereHas('status_bb', fn ($s) => $s->where('active', 'Y'))])
            ->orderBy('title', 'asc')
            ->paginate(10)
            ->appends($request->query());

        // Областные и крупные города РБ для фильтра (как на главной странице)
        $cities = Location::whereIn('title', ['Минск', 'Брест', 'Витебск', 'Гомель', 'Гродно', 'Могилев'])
            ->orderBy('id')
            ->get(['id', 'title']);

        return view('organizations.index', [
            'organizations' => $organizations,
            'cities'        => $cities,
        ]);
    }
public function organization_site_redirect($id){
        $site = Organization::where('id',$id)->pluck('site')->first();

    $site = preg_replace('/^(https?:)?(\/\/)?(www\.)?/', '', $site);

     return redirect()->away('//'.$site);
}
}
