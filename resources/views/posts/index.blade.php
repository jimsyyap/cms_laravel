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
                @if( $posts -> count() > 0 )
                    <table class="table table-hover">
                        <thead>
                            <th>
                                Image
                            </th>
                            <th>
                                Title
                            </th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <img src="{{ URL::asset('/storage/'.$post -> image) }}" width="180px" height="160px" alt="test image">
                                    </td>
                                    <td>
                                        {{ $post -> title }}
                                    </td>
                                    <td>
                                        @if(!$post -> trashed())
                                            {{-- if post not trashed, hide edit button --}}
                                            <a class="btn btn-outline-info btn-sm" href="">
                                                Edit
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('posts.destroy', $post -> id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">
                        No Posts.
                    </h3>
                @endif
            </div>
        </div>
    </div>
@endsection
