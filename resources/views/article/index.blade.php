@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h1>
                                Articles
                            </h1>
                        </div><!-- col-md-6 close -->
                        <div class="col-md-3 text-right">
                            <ul class="main-action">
                                <li>
                                    <a href="/article/new" class="btn-add"><i class="fa fa-plus-circle"></i></a><br>Add Article
                                </li>
                            </ul>
                        </div><!-- col-md-6 close -->
                    </div><!-- row close -->
                </div><!-- page-header close -->

                @include('partial.notification')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Articles List
                    </div><!-- panel-header close -->
                    <div class="panel-body">
                        <table data-type="articles" data-hospital-id="1" class="sortable table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="180">Background</th>
                                <th>Title</th>
                                <th>Notes</th>
                                <th width="160">Created</th>
                                <th width="160">Published</th>
                                <th width="120">Status</th>
                                <th width="120">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>
                                        @if(!empty($article->logo_file_name))
                                            <img src="/system/article/{{ $article->id }}/thumb/{{ $article->logo_file_name }}?1506548053" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $article->title }}
                                    </td>
                                    <td>
                                        {!! $article->notes !!}
                                    </td>
                                    <td>
                                        <span class="timestring">
                                            {{ $article->created_at }}
                                        </span> <br>
                                        {{ $article->user->name }}
                                    </td>
                                    <td>
                                        <span class="timestring">
                                            {{ $article->start_publishing }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($article->status == 0)
                                            Draft
                                        @elseif($article->status == 1)
                                            Published
                                        @elseif($article->status == 2)
                                            Archived
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-circle" title="Edit" href="/article/{{ $article->id }}/edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a data-confirm="Are you sure?" class="btn btn-danger btn-circle delete "
                                           title="Delete" rel="nofollow" data-method="delete"
                                           href="/article/{{ $article->id }}/destroy"><i
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