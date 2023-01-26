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
                    <form class="form-ad" action="{{route('addRubricToDB')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" value="{{old('title')}}" name="title" class="form-control" placeholder="Name">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6" id="container">

                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Сортировка</label>
                                    <input type="number" value="{{old('sort',500)}}" name="sort" class="form-control" placeholder="сортировка">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Родительская категория</label>
                                    <select name="parent_id">
                                        <option value="">Корневая категория</option>
                                        <?
                                        $traverse = function ($rubrics, $prefix = '-') use (&$traverse) {
                                            foreach ($rubrics as $rubric) {
                                                echo "<option value=".$rubric->id.">". PHP_EOL.$prefix.' '.$rubric->title."</option>";

                                                $traverse($rubric->children, $prefix.'-');
                                            }
                                        };

                                        $traverse($rubrics);
                                        ?>



</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" name="description" rows="7">{{old('description')}}</textarea>
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

