<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('inc.head')
</head>
<body>
    <div id="app">
        @include('inc.navtop')

        <main class="py-4">
            @auth
                <div class="container">
                    <div class="mb-2">
                        @if(session() -> has('success'))
                            <alert class="alert-success">
                            {{ session() -> get('success') }}
                            {{-- from controller --}}
                            </alert>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-group">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <a href="{{ route('posts.index') }}">
                                            Posts
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('categories.index') }}">
                                            Categories
                                        </a>
                                    </li>
                                </ul>
                                <ul class="list-group mt-4">
                                    <li class="list-group-item">
                                        <a href="{{ route('trashed-posts.index') }}">
                                            Trash Posts
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @else
                @yield('content')
            @endauth
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
