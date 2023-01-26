@extends('layouts.dashboard')

@section('main')
    <section class="add-resume section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="add-resume-inner box">

                        <form class="form-ad" action="{{route('editLocationToDB',['location'=>$location->id])}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" value="{{old('title',$location->title)}}" name="title" class="form-control" placeholder="Name">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6" id="container">

                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Сортировка</label>
                                        <input type="number" value="{{old('sort',$location->sort)}}" name="sort" class="form-control" placeholder="сортировка">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Родительская категория</label>
                                        <select name="parent_id" id="select_category">
                                            <option value="">Корневая категория</option>
                                            <?
                                            $traverse = function ($locations, $prefix = '-') use (&$traverse) {
                                                foreach ($locations as $locationl) {
                                                    echo "<option value=".$locationl->id." ";
                                                    echo ">". PHP_EOL.$prefix.' '.$locationl->title."</option>";

                                                    $traverse($locationl->children, $prefix.'-');
                                                }
                                            };

                                            $traverse($locations);
                                            ?>



                                        </select>
                                    </div>
                                </div>

                                <script>
                                    @isset ($location->parent_id)
                                    $('#select_category option[value={{$location->parent_id}}]').prop('selected', true);
                                    @endisset

                                    @foreach ($depth as $ch_cat)
                                        $('#select_category option[value="{{$ch_cat->id}}"]').attr('disabled','disabled');
                                    @endforeach
                                </script>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control" name="description" rows="7">{{old('description',$location->description)}}</textarea>
                                </div>

<button type="submit" class="btn" value="сохранить" >сохранить </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

