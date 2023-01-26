@extends('layouts.layout')

@section('dashboard')
    <section class="add-resume section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="add-resume-inner box">
                        <div class="post-header align-items-center justify-content-center">
                            <h3>Basic information</h3>
                            <p>Already have an account? <a href="javacript:" data-toggle="modal" data-target="#login" class="login"> Click here to login</a></p>
                        </div>
                        <form class="form-ad" action="{{route('editRubricToDB',['rubric'=>$rubric->id])}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" value="{{old('title',$rubric->title)}}" name="title" class="form-control" placeholder="Name">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6" id="container">

                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Сортировка</label>
                                        <input type="number" value="{{old('sort',$rubric->sort)}}" name="sort" class="form-control" placeholder="сортировка">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Родительская категория</label>
                                        <select name="parent_id" id="select_category">
                                            <option value="">Корневая категория</option>
                                            <?
                                            $traverse = function ($rubrics, $prefix = '-') use (&$traverse) {
                                                foreach ($rubrics as $rubricl) {
                                                    echo "<option value=".$rubricl->id." ";
                                                    echo ">". PHP_EOL.$prefix.' '.$rubricl->title."</option>";

                                                    $traverse($rubricl->children, $prefix.'-');
                                                }
                                            };

                                            $traverse($rubrics);
                                            ?>



                                        </select>
                                    </div>
                                </div>

                                <script>
                                    @isset ($rubric->parent_id)
                                    $('#select_category option[value={{$rubric->parent_id}}]').prop('selected', true);
                                    @endisset

                                    @foreach ($depth as $ch_cat)
                                        $('#select_category option[value="{{$ch_cat->id}}"]').attr('disabled','disabled');
                                    @endforeach
                                </script>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control" name="description" rows="7">{{old('description',$rubric->description)}}</textarea>
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <div class="col-lg-6 col-md-5 col-12">
                                        <div class="button">
                                            <button type="submit" class="btn">Save</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-12">
                                        <div class="add-post-btn float-right">
                                            <ul>
                                                <li><a href="#" class="btn-added"><i class="lni lni-add-files"></i> Add New
                                                        Skills</a></li>
                                                <li><a href="#" class="btn-delete"><i class="lni lni-remove-file"></i>
                                                        Delete This</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

