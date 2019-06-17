@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">

            <form class="new_announcement" id="new_announcement" enctype="multipart/form-data"
                  action="/announcement/new" accept-charset="UTF-8" method="post">
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
                                        <a href="/announcement/list" class="btn-cancel"><i
                                                    class="fa fa-minus-circle"></i></a><br>Cancel
                                    </li>
                                </ul>
                            </div><!-- col-md-6 close -->
                        </div><!-- row close -->
                    </div><!-- page-header close -->

                </div>

                <div class="col-md-8">
                    @include('partial.notification')
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Content
                        </div>
                        <div class="panel-body">

                            <div class="form-group ">
                                <label for="slider_background">Background</label>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <input class="form-control" type="file" name="announcement_background"
                                               id="announcement_background" value="{{ old('announcement_background') }}"/>
                                    </div><!-- panel-heading close -->
                                </div><!-- panel close -->
                            </div>

                            <div class="form-group ">
                                <label for="announcement_title">Title</label>
                                <textarea class="form-control" name="title" id="title">{{ old('title') }}
                                </textarea>
                            </div>
                            <div class="form-group ">
                                <label for="announcement_caption">Caption</label>
                                <textarea class="form-control" name="caption" id="caption">{{ old('caption') }}
                                </textarea>
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

                            <div class="form-group">
                                <label for="announcement_status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option  selected="selected"  value="0" @if(old('status') == "0") selected @endif>Draft</option>
                                    <option  value="1" @if(old('status') == "1") selected @endif>Published</option>
                                    <option  value="2" @if(old('status') == "2") selected @endif>Archived</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Start publishing</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' class="form-control" name="start_publishing" value="{{ old('start_publishing') }}" />
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
                                                   value="{{ old('stop_publishing') }}" />
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
    </div>
@endsection