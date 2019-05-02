@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">

            <form class="new_slider" id="new_slider" enctype="multipart/form-data"
                  action="/slider/new" accept-charset="UTF-8" method="post">
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
                                        <a href="/my-admin/hospitals/1/sliders" class="btn-cancel"><i
                                                    class="fa fa-minus-circle"></i></a><br>Cancel
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
                                </div><!-- panel close -->
                            </div>

                            <div class="form-group ">
                                <label for="slider_caption">Caption</label>
                                <textarea class="form-control" name="caption" id="caption">
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
                                <label for="slider_status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option  selected="selected"  value="0">Draft</option>
                                    <option  value="1">Published</option>
                                    <option  value="2">Archived</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Start publishing</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' class="form-control" name="start_publishing" value="" />
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
                                                   value="" />
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