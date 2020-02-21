@extends('layouts.app')

@section('title', 'Categories Index')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a class="btn btn-success" href="{{ route('categories.create') }}">
            Add Category
        </a>
    </div>
    <div class="mb-2">
        @if(session() -> has('success'))
            <alert class="alert-success">
            {{ session() -> get('success') }}
            {{-- from controller --}}
            </alert>
        @endif
    </div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>
                        Name
                    </th>
                    <th>
                    </th>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $category -> name }}
                            </td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('categories.edit', $category->id) }}" role="button">
                                    Edit
                                </a>
                                <button class="btn btn-outline-danger btn-sm" onclick="handleDelete({{ $category -> id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- modal show after delete --}}
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="POST" id="deleteCategoryForm">
                        @method('DELETE')
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-bold">
                                    Continue delete?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id){
            console.log('delete', id);
            var form = document.getElementById('deleteCategoryForm');
            form.action = '/categories/' + id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
