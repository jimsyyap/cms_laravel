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
                    <img src="{{ asset('/storage/'.$post -> image) }}" width="180px" height="160px" alt="test image">
                </td>
                <td>
                    {{ $post -> title }}
                </td>
                @if($post -> trashed())
                    <td>
                        <a class="btn btn-outline-info btn-sm" 
                           href="{{ route('posts.edit', $post -> id) }}">
                           Restore
                        </a>
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
