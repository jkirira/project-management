@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="level">
                            <span class="flex">
{{--                                <a href="{{ route('profile', $issue->creator) }}">{{ $issue->creator->name }}</a> posted:  {{ $issue->title }}--}}
                                <p>{{ $issue->creator->name }}</p> posted:  {{ $issue->title }}
                            </span>


{{--                            @can('update', $issue)--}}
                                <form action="{{ $issue->path() }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
{{--                            @endcan--}}
{{----}}
                        </div>
                    </div>

                    <div class="panel-body">
                        {{ $issue->body }}
                    </div>
                </div>

                @foreach($replies as $reply)
                    @include('issues.reply')
                @endforeach

                {{ $replies->links() }}

                @if(auth()->check())
                    <form method="POST" action="{{ $issue->path().'/replies' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows = 5>
                            </textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Post</button>

                    </form>

                @else
                    <p class="text-center">Please <a href=" {{ route('login') }}">sign in</a> to participate in this discussion</p>
                @endif

            </div>

            <div class="col-md-4">

                <div class="panel panel-default">
                    <div class="panel-body">
                        This issue was published at {{ $issue->created_at->diffForHumans() }} by
                        <a href="#"> {{ $issue->creator->name}}</a> and currently has {{ $issue->replies_count }} {{ str_plural('comment', $issue->replies_count) }}.
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
