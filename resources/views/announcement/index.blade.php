@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h1>
                                Announcements
                            </h1>
                        </div><!-- col-md-6 close -->
                        <div class="col-md-3 text-right">
                            <ul class="main-action">
                                <li>
                                    <a href="/announcement/new" class="btn-add"><i class="fa fa-plus-circle"></i></a><br>Add Announcement
                                </li>
                            </ul>
                        </div><!-- col-md-6 close -->
                    </div><!-- row close -->
                </div><!-- page-header close -->

                @include('partial.notification')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sliders List
                    </div><!-- panel-header close -->
                    <div class="panel-body">
                        <table data-type="sliders" data-hospital-id="1" class="sortable table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="180">Background</th>
                                <th>Title</th>
                                <th>Caption</th>
                                <th width="160">Created</th>
                                <th width="160">Published</th>
                                <th width="120">Status</th>
                                <th width="120">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($announcements as $announcement)
                                <tr>
                                    <td>
                                        @if(!empty($announcement->featured_file_name))
                                            <img src="/system/announcement/{{ $announcement->id }}/thumb/{{ $announcement->featured_file_name }}?1506548053" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $announcement->title }}
                                    </td>
<td>
                                        {{ $announcement->caption }}
                                    </td>

                                    <td>
                                        <span class="timestring">
                                            {{ $announcement->created_at }}
                                        </span> <br>
                                        {{ $announcement->user->name }}
                                    </td>
                                    <td>
                                        <span class="timestring">
                                            {{ $announcement->start_publishing }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($announcement->status == 0)
                                            Draft
                                        @elseif($announcement->status == 1)
                                            Published
                                        @elseif($announcement->status == 2)
                                            Archived
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-circle" title="Edit" href="/announcement/{{ $announcement->id }}/edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a data-confirm="Are you sure?" class="btn btn-danger btn-circle delete "
                                           title="Delete" rel="nofollow" data-method="delete"
                                           href="/announcement/{{ $announcement->id }}/destroy"><i
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