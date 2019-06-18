@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h1>
                                Services
                            </h1>
                        </div><!-- col-md-6 close -->
                        <div class="col-md-3 text-right">
                            <ul class="main-action">
                                <li>
                                    <a href="/service/new" class="btn-add"><i class="fa fa-plus-circle"></i></a><br>Add Service
                                </li>
                            </ul>
                        </div><!-- col-md-6 close -->
                    </div><!-- row close -->
                </div><!-- page-header close -->

                @include('partial.notification')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Services List
                    </div><!-- panel-header close -->
                    <div class="panel-body">
                        <table data-type="services" data-hospital-id="1" class="sortable table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="180">Background</th>
                                <th>Title</th>
                                <th>Url</th>
                                <th>Notes</th>
                                <th width="160">Created</th>
                                <th width="160">Published</th>
                                <th width="120">Status</th>
                                <th width="120">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>
                                        @if(!empty($service->featured_file_name))
                                            <img src="/system/service/{{ $service->id }}/thumb/{{ $service->featured_file_name }}?1506548053" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $service->title }}
                                    </td>
                                     <td>
                                        {{ $service->url }}
                                    </td>
                                    <td>
                                        {!! $service->notes !!}
                                    </td>
                                    <td>
                                        <span class="timestring">
                                            {{ $service->created_at }}
                                        </span> <br>
                                        {{ $service->user->name }}
                                    </td>
                                    <td>
                                        <span class="timestring">
                                            {{ $service->start_publishing }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($service->status == 0)
                                            Draft
                                        @elseif($service->status == 1)
                                            Published
                                        @elseif($service->status == 2)
                                            Archived
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-circle" title="Edit" href="/service/{{ $service->id }}/edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a data-confirm="Are you sure?" class="btn btn-danger btn-circle delete "
                                           title="Delete" rel="nofollow" data-method="delete"
                                           href="/service/{{ $service->id }}/destroy"><i
                                                    class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- panel-body close -->
                </div><!-- panel panel-default close -->

            </div><!-- col-md-12 close -->
        </div><!-- row close -->
    </div>
@endsection