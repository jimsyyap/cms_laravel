@extends('layouts.app')

@section('title', 'Posts Index')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a class="btn btn-primary" href="{{ route('posts.create') }}">Add Post</a>
    </div>
    <div class="card">
        <div class="card-default">
            <div class="card-header">
                Posts
            </div>
            <div class="card-body">
                <table>
                </table>
            </div>
        </div>
    </div>
@endsection
