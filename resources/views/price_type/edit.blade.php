@extends('layouts.dashboard')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="form-ad" action="{{route('editPriceTypetoDB',[$type->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Тип</label>
                                        <input type="text" value="{{old('type',$type->type)}}"  name="type" class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-5 col-12">
                                    <div class="button">
                                        <button type="submit" class="btn">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection


