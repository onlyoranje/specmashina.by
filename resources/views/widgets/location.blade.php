<div class="single-widget search-form mt-0">

    <div class="search-input">
        <label for="location"><i class="lni lni-map-marker theme-color"></i></label>
        <select name="location" id="location" onchange="SelectLocation()">
            <option value="none" selected="" disabled="">Города</option>
            <option value="" {{ !$request->location ? 'selected':''}}>- Все города -</option>
            @foreach($locations as $location)
            <option value="{{$location->id}}" {{ $request->location==$location->id ? 'selected':''}}>{{$location->title}}</option>
            @endforeach
        </select>
    </div>
</div>


