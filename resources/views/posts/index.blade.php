@extends('layouts.app')

@section('title', 'Posts Index')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        {{-- TODO if on trashed-post, hide add post button --}}
        <a class="btn btn-primary" href="{{ route('posts.create') }}">Add Post</a>
    </div>
    <div class="card">
        <div class="card-default">
            <div class="card-header">
                Posts
            </div>
            <div class="card-body">
                @if( $posts -> count() > 0 )
                    @include('posts._posts')
                @else
                    <h3 class="text-center">
                        No Posts.
                    </h3>
                @endif
            </div>
        </div>
    </div>
@endsection
