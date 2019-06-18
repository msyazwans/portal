@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">

            <form class="edit_link" id="edit_link_8" enctype="multipart/form-data"
                  action="/link/{{ $link->id }}/edit"
                  accept-charset="UTF-8" method="post">
                {{ csrf_field() }}
                <div class="col-lg-12">


                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>
                                    Link
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
                                        <a href="/link/list"
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

                            @include('partial.notification')
                            <div class="form-group ">
                                <label for="link_background">Background</label>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <input class="form-control" type="file" name="link_background"
                                               id="link_background"/>
                                    </div><!-- panel-heading close -->
                                    @if (isset($link->logo_file_name) && !empty($link->logo_file_name))
                                        <div class="panel-body">
                                            <div class="photo_wrap">
                                                <img src="/system/link/{{ $link->id }}/medium/{{ $link->logo_file_name }}?1506548053"
                                                     alt="">
                                            </div><!-- photo_wrap close -->
                                        </div><!-- panel-body close -->
                                        <div class="panel-footer">
                                            <a class="btn btn-default"
                                               href="/link/{{ $link->id }}/remove_photo">Remove
                                                Featured Photo</a>
                                        </div><!-- panel-footer close -->
                                    @endif
                                </div><!-- panel close -->
                            </div>

                            <div class="form-group ">
                                <label for="link_title">Title</label>
                                <textarea class="form-control" name="title" id="title">{{ $link->title }}</textarea>
                            </div>
                            <div class="form-group ">
                                <label for="link_url">Url</label>
                                <textarea class="form-control" name="url" id="url">{{ $link->url }}</textarea>
                            </div>
                            <script>
                                var options = {
                                    height: '500px'
                                };
                                (function(){
                                    if (typeof CKEDITOR != 'undefined'){
                                        if (CKEDITOR.instances['notes']){
                                            CKEDITOR.instances['notes'].destroy();
                                        }
                                        CKEDITOR.replace('notes',options);
                                        CKEDITOR.config.extraPlugins = 'colorbutton,justify,font';
                                    }
                                })();
                            </script>
                        </div><!-- panel-body close -->
                    </div><!-- panel panel-info close -->
                </div><!-- col-lg-4 close -->

                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-cog"></i> Publish Settings
                        </div>
                        <div class="panel-body">

                            @if(Auth::user()->role == 'super'  || Auth::user()->role == 'admin')
                                <div class="form-group">
                                    <label for="link_status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option @if(old('status',$link->status) == 0) selected="selected" @endif value="0">Draft</option>
                                        <option @if(old('status',$link->status) == 1) selected="selected" @endif value="1">Published</option>
                                        <option @if(old('status',$link->status) == 2) selected="selected" @endif value="2">Archived</option>
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Start publishing</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' class="form-control" name="start_publishing"
value="@if(!empty(old('start_publishing',$link->start_publishing)))
{{ old('start_publishing',\Carbon\Carbon::parse($link->start_publishing)->format('d-m-Y')) }}@endif" />
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
                                            <input type='text' class="form-control" name="stop_publishing"
                                                   value="@if (!empty(old('stop_publishing',$link->stop_publishing))){{ old('stop_publishing',\Carbon\Carbon::parse($link->stop_publishing)->format('d-m-Y')) }}@endif" />
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