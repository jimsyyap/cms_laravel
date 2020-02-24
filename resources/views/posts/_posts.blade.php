<table class="table table-hover">
    <thead>
        <th>
            Image
        </th>
        <th>
            Title
        </th>
        <th>
            Category
        </th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <td>
                    <img src="{{ asset('/storage/'.$post -> image) }}" width="180px" height="160px" alt="test image">
                </td>
                <td>
                    {{ $post -> title }}
                </td>
                <td>
                    <a href="{{ route('categories.edit', $post -> category -> id) }}">
                        {{$post -> category -> name}}
                    </a>
                </td>
                @if($post -> trashed())
                    <td>
                        <form action="{{ route('restore-post', $post -> id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-outline-info btn-sm" type="submit">
                               Restore
                            </button>
                        </form>
                    </td>
                @else
                    <td>
                        <a class="btn btn-outline-info btn-sm" 
                           href="{{ route('posts.edit', $post -> id) }}">
                           Edit
                        </a>
                    </td>
                @endif
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
