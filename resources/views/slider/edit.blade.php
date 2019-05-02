@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">

            <form class="edit_slider" id="edit_slider_8" enctype="multipart/form-data"
                  action="/slider/{{ $slider->id }}/edit"
                  accept-charset="UTF-8" method="post">
                {{ csrf_field() }}
                <div class="col-lg-12">

                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>
                                    Slider
                                </h1>
                            </div><!-- col-md-6 close -->
                            <div class="col-md-6 text-right">
                                <ul class="main-action">
                                    <li>
                                        <button name="button" type="submit" class=" btn-save action-save">
                                            <i class="fa fa-check-circle"></i>
                                        </button>
                                        <br>Save
                                    </li>
                                    <li>
                                        <a href="/slider/list"
                                           class="btn-cancel"><i class="fa fa-minus-circle"></i></a><br>Cancel
                                    </li>
                                </ul>
                            </div><!-- col-md-6 close -->
                        </div><!-- row close -->
                    </div><!-- page-header close -->

                </div>

                <div class="col-md-8">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Content
                        </div>
                        <div class="panel-body">


                            <div class="form-group ">
                                <label for="slider_background">Background</label>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <input class="form-control" type="file" name="slider_background"
                                               id="slider_background"/>
                                    </div><!-- panel-heading close -->
                                    @if (isset($slider->background_file_name) && !empty($slider->background_file_name))
                                        <div class="panel-body">
                                            <div class="photo_wrap">
                                                <img src="/system/slider/medium/{{ $slider->background_file_name }}?1506548053"
                                                     alt="">
                                            </div><!-- photo_wrap close -->
                                        </div><!-- panel-body close -->
                                        <div class="panel-footer">
                                            <a class="btn btn-default"
                                               href="/slider/{{ $slider->id }}/remove_photo">Remove
                                                Featured Photo</a>
                                        </div><!-- panel-footer close -->
                                    @endif
                                </div><!-- panel close -->
                            </div>

                            <div class="form-group ">
                                <label for="slider_caption">Caption</label>
                                <textarea class="form-control" name="caption" id="caption">
{{ $slider->caption }}</textarea>
                            </div>

                        </div><!-- panel-body close -->
                    </div><!-- panel panel-info close -->
                </div><!-- col-lg-4 close -->

                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-cog"></i> Publish Settings
                        </div>
                        <div class="panel-body">

                            @if(Auth::user()->role == 'super'  || Auth::user()->role == 'content')
                                <div class="form-group">
                                    <label for="slider_status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option @if(old('status',$slider->status) == 0) selected="selected" @endif value="0">Draft</option>
                                        <option @if(old('status',$slider->status) == 1) selected="selected" @endif value="1">Published</option>
                                        <option @if(old('status',$slider->status) == 2) selected="selected" @endif value="2">Archived</option>
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Start publishing</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' class="form-control" name="start_publishing" value="@if (!empty(old('start_publishing',$slider->start_publishing))){{ old('start_publishing',\Carbon\Carbon::parse($slider->start_publishing)->format('d-m-Y')) }}@endif" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function () {
                                            $('#datetimepicker1').datepicker({
                                                format: 'dd-mm-yyyy'
                                            });
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Stop publishing</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class='input-group date' id='datetimepicker2'>
                                            <input type='text' class="form-control" name="stop_publishing" value="@if (!empty(old('stop_publishing',$slider->stop_publishing))){{ old('stop_publishing',\Carbon\Carbon::parse($slider->stop_publishing)->format('d-m-Y')) }}@endif" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function () {
                                            $('#datetimepicker2').datepicker({
                                                format: 'dd-mm-yyyy'
                                            });
                                        });
                                    </script>
                                </div>
                            </div>

                        </div><!-- panel-body close -->
                    </div><!-- panel panel-info close -->
                </div><!-- col-md-4 close -->
            </form>

        </div><!-- row close -->
    </div><!-- page-wrapper close -->
@endsection