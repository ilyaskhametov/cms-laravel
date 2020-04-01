<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="logo">
                </a>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pages.index') ? 'active' : null }}"
                           href="{{ route('pages.index') }}">Pages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('media_files.index') ? 'active' : null }}"
                           href="{{ route('media_files.index') }}">Media files</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>