@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @forelse($issues as $issue)
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <div class="level">
                                <h4 class="flex">
                                    <a href="{{ $issue->path() }}">
                                        {{ $issue->title }}
                                    </a>
                                </h4>

                                <a href="{{$issue->path()}}">{{ $issue->replies_count }} {{ str_plural('reply', $issue->replies_count) }}</a>
                            </div>

                        </div>

                        <div class="panel-body">
                            <div class="body">{{ $issue->body }}</div>
                        </div>

                    </div>
                @empty
                    <p>There are no issues at this time.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
